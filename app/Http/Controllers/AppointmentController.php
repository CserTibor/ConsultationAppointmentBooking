<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentCreateRequest;
use App\Models\Appointment;
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
        $appointments = Appointment::with('publishers', 'holders')
//            ->where('date', '>', Carbon::now())
//            ->where('is_reserved', '=', false)
            ->get();
        return View::make('appointments-list', ['appointments' => $appointments]);
    }


    public function create()
    {
        return View::make('appointment-create');
    }


    public function store(AppointmentCreateRequest $request)
    {
        $requestData = $request->only('length', 'date');

        $user = auth()->user();
        $appointment = Appointment::create([
            'length' => $requestData['length'],
            'date' => Carbon::parse($requestData['date']),
            'is_reserved' => false,
        ]);
        UserAppointment::create([
            'publisher_id' => $user->id,
            'appointment_id' => $appointment->id,
        ]);

        return redirect('/appointments');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
