<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Organization;
use App\Models\Appointment;

class VisitorController extends Controller
{
    public function create()
{
    $lastVisitor = Visitor::latest('visitor_number')->first();
    $lastVisitorNumber = $lastVisitor ? (int) $lastVisitor->visitor_number : 0;

    $nextVisitorNumber = str_pad($lastVisitorNumber + 1, 3, '0', STR_PAD_LEFT);

    return view('receptionist.walk-in', compact('nextVisitorNumber'));
}

public function notifications()
{
    // Fetch the approved appointments, excluding completed ones
    $approvedAppointments = Appointment::where('status', 'approved')
        ->where('status', '!=', 'completed')  // Exclude completed appointments
        ->orderBy('updated_at', 'desc')  // Order by the most recent update
        ->get();

    return view('visitor.notifications', compact('approvedAppointments'));
}


public function store(Request $request)
{
    $request->validate([
        'visitor_number' => 'required|unique:visitors',
        'full_name' => 'required|string|max:255',
        'age' => 'required|integer|min:1',
        'floor' => 'required|integer|min:1',
        'host' => 'required|string|max:255',
        'visit_time' => 'required|date',
    ]);

    $hostExists = Organization::where('name', $request->host)->exists();

    if (!$hostExists) {
        return back()
            ->withErrors(['host' => 'The specified host does not exist in the organization.'])
            ->withInput();
    }

    $floor = $request->floor;
    $floorWithSuffix = $this->getOrdinalSuffix($floor);

    Visitor::create([
        'visitor_number' => $request->visitor_number,
        'full_name' => $request->full_name,
        'age' => $request->age,
        'floor' => $floorWithSuffix,
        'host' => $request->host,
        'visit_time' => $request->visit_time,
    ]);

    return redirect()->route('walk-in.create')->with('success', 'Visitor registered successfully!');
}


private function getOrdinalSuffix($n)
{
    if ($n >= 11 && $n <= 13) {
        return $n . "th";
    }
    switch ($n % 10) {
        case 1: return $n . "st";
        case 2: return $n . "nd";
        case 3: return $n . "rd";
        default: return $n . "th";
    }
}


public function search(Request $request)
{
    $query = $request->input('query');

    $visitors = Visitor::whereNull('logged_out_at')
        ->where(function ($q) use ($query) {
            $q->where('visitor_number', 'like', "%$query%")
              ->orWhere('full_name', 'like', "%$query%")
              ->orWhere('host', 'like', "%$query%");
        })
        ->get();

    return view('receptionist.log-out', compact('visitors'));
}

public function logout($id)
{
    $visitor = Visitor::findOrFail($id);
    $visitor->update(['logged_out_at' => now()]);

    return redirect()->route('log-out.search')->with('success', 'Visitor logged out successfully!');
}

public function visitHistory()
{
    $userId = Auth::id(); // get logged-in user's ID
    $appointments = Appointment::where('user_id', $userId)
        ->get(['name', 'purpose', 'status', 'preferred_date_time', 'created_at']);

    return view('visitor.visit-history', compact('appointments'));
}
}

