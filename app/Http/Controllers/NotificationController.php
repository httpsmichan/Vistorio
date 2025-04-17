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
                    $query->where('visit_time', '<=', now()->addHour())
                        ->whereNull('logged_out_at');
                })
                ->orWhere(function ($query) {
                    $query->whereNotNull('logged_out_at')
                        ->where('logged_out_at', '<', now());
                })
                ->orderByDesc('visit_time') // 🟡 Sort by most recent visit
                ->get();

            // Past appointments (those whose preferred date time has passed and are not yet completed)
            $pastAppointments = Appointment::where('preferred_date_time', '<', now())
                ->where('status', '!=', 'Completed')
                ->orderByDesc('preferred_date_time') // 🟡 Sort by most recent past
                ->get();

            // Completed appointments
            $completedAppointments = Appointment::where('status', 'completed')
                ->orderByDesc('updated_at') // 🟡 Sort by most recently updated
                ->get();

            return view('receptionist.notification', compact(
                'visitorNotifications',
                'pastAppointments',
                'completedAppointments'
            ));
        }
}

