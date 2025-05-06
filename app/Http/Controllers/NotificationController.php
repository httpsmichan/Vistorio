<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\Appointment;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
        {
            $visitorNotifications = Visitor::where(function ($query) {
                    $query->where('visit_time', '<=', now()->addHour())
                        ->whereNull('logged_out_at');
                })
                ->orWhere(function ($query) {
                    $query->whereNotNull('logged_out_at')
                        ->where('logged_out_at', '<', now());
                })
                ->orderByDesc('visit_time') 
                ->get();

            $pastAppointments = Appointment::where('preferred_date_time', '<', now())
                ->where('status', '!=', 'Completed')
                ->orderByDesc('preferred_date_time') 
                ->get();

            // Completed appointments
            $completedAppointments = Appointment::where('status', 'completed')
                ->orderByDesc('updated_at') 
                ->get();

            return view('receptionist.notification', compact(
                'visitorNotifications',
                'pastAppointments',
                'completedAppointments'
            ));
        }
}

