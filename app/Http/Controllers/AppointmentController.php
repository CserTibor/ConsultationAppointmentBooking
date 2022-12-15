<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentCreateRequest;
use App\Models\Appointment;
use App\Repositories\AppointmentRepository;
use App\Repositories\TypeRepository;
use App\Services\AppointmentService;
use Illuminate\Support\Facades\View;

class AppointmentController extends Controller
{
    /**
     * @var AppointmentService
     */
    private AppointmentService $appointmentService;
    /**
     * @var TypeRepository
     */
    private TypeRepository $typeRepository;
    /**
     * @var AppointmentRepository
     */
    private AppointmentRepository $appointmentRepository;

    /**
     * AppointmentController constructor.
     * @param AppointmentService $appointmentService
     * @param AppointmentRepository $appointmentRepository
     * @param TypeRepository $typeRepository
     */
    public function __construct(
        AppointmentService $appointmentService,
        AppointmentRepository $appointmentRepository,
        TypeRepository $typeRepository
    )
    {
        $this->appointmentService = $appointmentService;
        $this->typeRepository = $typeRepository;
        $this->appointmentRepository = $appointmentRepository;
    }

    public function index()
    {
        return View::make('appointments-list', ['appointments' => $this->appointmentService->list(), 'user' => auth()->user()]);
    }


    public function create()
    {
        return View::make('appointment-create', ['types' => $this->typeRepository->all()]);
    }

    public function store(AppointmentCreateRequest $request)
    {
        $requestData = $request->only('length', 'date', 'types');
        $this->appointmentService->create($requestData);

        return redirect('/appointments');
    }

    public function seize(Appointment $appointment)
    {
        $this->appointmentService->seize($appointment);
        return redirect('/appointments');
    }

    public function myAppointments()
    {
        return View::make('my-appointments-list', ['appointments' => $this->appointmentService->myAppointments(), 'user' => auth()->user()]);
    }

    public function delete(Appointment $appointment)
    {
        $this->appointmentRepository->delete($appointment);

        return redirect('/users/appointments');
    }

    public function resign(Appointment $appointment)
    {
        $this->appointmentService->resign($appointment);
        return redirect('/users/appointments');
    }
}
