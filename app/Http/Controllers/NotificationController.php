<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\Appointment;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
{
    // Visitors whose visit time is within 1 hour or exceeded, including those who have logged out
    $visitorNotifications = Visitor::where(function ($query) {
            // Visitors with remaining time or those who exceeded the allowed visit time
            $query->where('visit_time', '<=', now()->addHour())
                  ->whereNull('logged_out_at');
        })
        ->orWhere(function ($query) {
            // Visitors who have logged out, but we need to check if the visit time has exceeded
            $query->whereNotNull('logged_out_at')
                  ->where('logged_out_at', '<', now());
        })
        ->get();

    // Past appointments (those whose preferred date time has passed and are not yet completed)
    $pastAppointments = Appointment::where('preferred_date_time', '<', now())
        ->where('status', '!=', 'Completed')
        ->get();

    // Completed appointments
    $completedAppointments = Appointment::where('status', 'completed')->get();

    // Pass the data to the view
    return view('receptionist.notification', compact('visitorNotifications', 'pastAppointments', 'completedAppointments'));
}

}

