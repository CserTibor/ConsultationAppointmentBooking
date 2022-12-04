<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentCreateRequest;
use App\Models\Appointment;
use App\Models\Type;
use App\Models\User;
use App\Models\UserAppointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AppointmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $user = auth()->user();
        $query = Appointment::with('publishers', 'holders')->where('date', '>', Carbon::now());

        if ($user->isTeacher()) {
            $query->whereHas('publishers', function ($query) use ($user) {
                $query->where('publisher_id', '=', $user->id);
            });
        } elseif ($user->isStudent()) {
            $query->where('is_reserved', '=', false);
        }

        $appointments = $query->get();

        return View::make('appointments-list', ['appointments' => $appointments]);
    }


    public function create()
    {
        $types = Type::all();
        return View::make('appointment-create', ['types' => $types]);
    }


    public function store(AppointmentCreateRequest $request)
    {
        $requestData = $request->only('length', 'date', 'types');

        $user = auth()->user();
        $appointment = Appointment::create([
            'length' => $requestData['length'],
            'date' => Carbon::parse($requestData['date']),
            'is_reserved' => false,
        ]);

        $appointment->types()->sync($requestData['types']);

        UserAppointment::create([
            'publisher_id' => $user->id,
            'appointment_id' => $appointment->id,
        ]);


        return redirect('/appointments');
    }

    public function seize($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['is_reserved' => true]);
        UserAppointment::where('appointment_id', '=', $id)->update(['holder_id' => auth()->id()]);

        return redirect('/appointments');
    }

    public function myAppointments()
    {
        $user = auth()->user();

        $query = Appointment::query();
        if ($user->isTeacher()) {
            $query->whereHas('publishers', function ($query) use ($user) {
                $query->where('publisher_id', '=', $user->id);
            });
        } elseif ($user->isStudent()) {
            $query->whereHas('holders', function ($query) use ($user) {
                $query->where('holder_id', '=', $user->id);
            });
        }

        $appointments = $query->get();

        return View::make('my-appointments-list', ['appointments' => $appointments]);
    }

    public function delete($id)
    {
        $appointment = Appointment::where('id', '=', $id)->delete();

        return redirect('/users/appointments');
    }
}
