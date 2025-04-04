<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('user_id', Auth::id())->get();

        // Pass appointments to the view
        return view('visitor.appointment', compact('appointments'));
    }

    public function create()
    {
        return view('visitor.appointment');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'purpose' => 'required|string',
            'preferred_date_time' => 'required|date',
            'host' => 'required|string|max:255',
        ]);
    
        Appointment::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'purpose' => $request->purpose,
            'preferred_date_time' => $request->preferred_date_time,
            'host' => $request->host,
        ]);
    
        return redirect()->route('appointments')->with('success', 'Appointment booked successfully!');
    }

    public function lookup(Request $request)
    {
        $query = $request->input('query');

        // Fetch only approved appointments based on search input (name, date, email, etc.)
        $appointments = Appointment::where('status', 'approved')
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%$query%")
                ->orWhere('email', 'like', "%$query%")
                ->orWhere('phone_number', 'like', "%$query%")
                ->orWhere('preferred_date_time', 'like', "%$query%");
            })
            ->get();

        return view('receptionist.appointment-lookup', compact('appointments'));
    }

public function updateStatus(Request $request)
{
    $appointments = $request->input('appointments', []);

    foreach ($appointments as $appointmentId => $status) {
        $appointment = Appointment::find($appointmentId);
        if ($appointment) {
            $appointment->status = $status; // set status as 'done'
            $appointment->save();
        }
    }

    return redirect()->route('receptionist.appointments.lookup')->with('status', 'Appointment statuses updated.');
}

}
