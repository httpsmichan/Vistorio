<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $appointments = Appointment::all();
        $approvedAppointments = Appointment::where('status', 'approved')->get();
        return view('admin', compact('users', 'appointments', 'approvedAppointments'));
    }

    public function create()
    {
        return view('admin.add');
    }

    public function appointments()
    {
        $appointments = Appointment::all(); // Fetch all appointments
        $approvedAppointments = Appointment::where('status', 'approved')->get(); // Fetch approved appointments
        return view('admin.appointment', compact('appointments', 'approvedAppointments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:visitor,host,admin,receptionist',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin')->with('success', 'New account added successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin')->with('success', 'User deleted successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:visitor,host,admin,receptionist',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email', 'role']));

        return redirect()->route('admin')->with('success', 'User updated successfully');
    }

    public function users()
    {
        $users = User::all();
        return view('admin.user', compact('users'));
    }
}

