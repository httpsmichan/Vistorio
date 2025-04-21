<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Appointment;

class HostController extends Controller
{
    public function manageAppointments()
        {
            $appointments = Appointment::all();
            return view('host.manage-appointments', compact('appointments'));
        }

        public function updateStatus(Request $request)
        {
            $appointment = Appointment::find($request->id);
            if ($appointment) {
                $appointment->status = $request->status;
                $appointment->save();
                return response()->json(['success' => 'Status updated successfully']);
            }
            return response()->json(['error' => 'Appointment not found'], 404);
        }

        public function showAppointmentLogs() 
{
    // Retrieve all appointments and separate them into booked and completed logs
    $bookedAppointments = Appointment::where('status', '!=', 'completed') // Only include booked appointments
        ->orderBy('created_at', 'desc') // Order by created_at (booking date)
        ->get();

    $completedAppointments = Appointment::where('status', 'completed') // Only include completed appointments
        ->orderBy('updated_at', 'desc') // Order by updated_at (completion date)
        ->get();

    return view('host.appointment-log', compact('bookedAppointments', 'completedAppointments'));
}

public function showVisitorLogs()
{
    // Retrieve visitors who have a value for 'logged_out_at'
    $visitors = \App\Models\Visitor::whereNotNull('logged_out_at')->get();

    return view('host.visitor-logs', compact('visitors'));
}

public function calendarView()
{
    // Fetch only approved or completed appointments
    $appointments = Appointment::whereIn('status', ['approved', 'completed'])
                               ->orderBy('preferred_date_time', 'desc')
                               ->get();

    // Get the current month and year
    $currentMonth = \Carbon\Carbon::now()->month;
    $currentYear = \Carbon\Carbon::now()->year;

    // Generate the first and last days of the month
    $firstDayOfMonth = \Carbon\Carbon::createFromDate($currentYear, $currentMonth, 1);
    $lastDayOfMonth = \Carbon\Carbon::createFromDate($currentYear, $currentMonth, $firstDayOfMonth->daysInMonth);

    // Group the appointments by date (Y-m-d)
    $groupedAppointments = $appointments->groupBy(function ($item) {
        return \Carbon\Carbon::parse($item->preferred_date_time)->format('Y-m-d');
    });

    return view('host.calendar', compact('firstDayOfMonth', 'lastDayOfMonth', 'groupedAppointments', 'currentMonth', 'currentYear'));
}

public function showNotifications()
    {
        // Fetch visitor notifications (those who are approaching time limit or have logged out)
        $visitorNotifications = Visitor::all();

        // Fetch past appointments
        $pastAppointments = Appointment::where('status', '!=', 'completed') // Filter out completed appointments
            ->where('preferred_date_time', '<', now()) // Only past appointments
            ->orderBy('preferred_date_time', 'desc')
            ->get();

        // Fetch completed appointments
        $completedAppointments = Appointment::where('status', 'completed')
            ->orderBy('updated_at', 'desc')
            ->get();

        // Return view with all the necessary data
        return view('host.hostnotifications', compact('visitorNotifications', 'pastAppointments', 'completedAppointments'));
    }


}
