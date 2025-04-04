<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        
}
