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

        //query appointments based on filter type
        // filter_type: status or date
        public function showAppointmentLogs(Request $request)
        {
            $query = Appointment::query();
        
            if ($request->filter_type === 'status' && $request->status && $request->status !== 'all') {
                $query->where('status', $request->status);
            }
        
            if ($request->filter_type === 'date' && $request->date) {
                $query->whereDate('created_at', $request->date);
            }
        
            $appointments = $query->orderBy('created_at', 'desc')->get();
        
            return view('host.appointment-log', compact('appointments'));
        }
        


public function showVisitorLogs()
{
    $visitors = \App\Models\Visitor::whereNotNull('logged_out_at')->get();

    return view('host.visitor-logs', compact('visitors'));
}

public function calendarView()
{
    $appointments = Appointment::whereIn('status', ['approved', 'completed'])
                               ->orderBy('preferred_date_time', 'desc')
                               ->get();

    $currentMonth = \Carbon\Carbon::now()->month;
    $currentYear = \Carbon\Carbon::now()->year;

    $firstDayOfMonth = \Carbon\Carbon::createFromDate($currentYear, $currentMonth, 1);
    $lastDayOfMonth = \Carbon\Carbon::createFromDate($currentYear, $currentMonth, $firstDayOfMonth->daysInMonth);

    $groupedAppointments = $appointments->groupBy(function ($item) {
        return \Carbon\Carbon::parse($item->preferred_date_time)->format('Y-m-d');
    });

    return view('host.calendar', compact('firstDayOfMonth', 'lastDayOfMonth', 'groupedAppointments', 'currentMonth', 'currentYear'));
}

public function showNotifications()
    {
        $visitorNotifications = Visitor::all();

        $pastAppointments = Appointment::where('status', '!=', 'completed') 
            ->where('preferred_date_time', '<', now()) 
            ->orderBy('preferred_date_time', 'desc')
            ->get();

        $completedAppointments = Appointment::where('status', 'completed')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('host.hostnotifications', compact('visitorNotifications', 'pastAppointments', 'completedAppointments'));
    }


}
