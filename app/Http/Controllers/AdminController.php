<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use DB;
use App\Models\Organization;

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
        $nextId = User::max('id') + 1;
        return view('admin.user', compact('users', 'nextId'));
    }

    public function showEmployeeForm(Request $request)
    {
        // Get the search query from the request (if any)
        $search = $request->query('search');

        // Fetch employees from the organization table, apply search filter if needed
        if ($search) {
            $employees = DB::table('organization')
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('position', 'like', '%' . $search . '%')
                ->get();
        } else {
            // If no search query, get all employees
            $employees = DB::table('organization')->get();
        }

        // Pass the employees to the view
        return view('admin.employees', compact('employees'));
    }

    public function storeEmployee(Request $request)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);

        // Insert data into the 'organization' table
        DB::table('organization')->insert([
            'name' => $request->name,
            'position' => $request->position,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect back to the employee management page
        return redirect()->route('admin.employees');
    }

    public function editEmployee($id)
{
    $employee = DB::table('organization')->where('id', $id)->first();

    if (!$employee) {
        return redirect()->route('admin.employees')->with('error', 'Employee not found.');
    }

    return view('admin.employee_edit', compact('employee'));
}

public function updateEmployee(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
    ]);

    DB::table('organization')->where('id', $id)->update([
        'name' => $request->name,
        'position' => $request->position,
        'updated_at' => now(),
    ]);

    return redirect()->route('admin.employees')->with('success', 'Employee updated successfully.');
}

public function destroyEmployee($id)
{
    DB::table('organization')->where('id', $id)->delete();
    return redirect()->route('admin.employees')->with('success', 'Employee deleted successfully.');
}

}

