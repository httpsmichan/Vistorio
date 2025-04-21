<?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use App\Models\Appointment;
    use App\Models\Visitor;
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
            $visitors = Visitor::all();

            $userRegistrationsByDay = DB::table('users')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc')
            ->get();

            $visitorRegistrationsByDay = DB::table('visitors')
            ->select(DB::raw('DATE(visit_time) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('DATE(visit_time)'))
            ->orderBy('date', 'asc')
            ->get();

            $appointmentsByDay = DB::table('appointments')
            ->select(DB::raw('DATE(preferred_date_time) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('DATE(preferred_date_time)'))
            ->orderBy('date', 'asc')
            ->get();


            return view('admin', compact(
                'users',
                'appointments',
                'approvedAppointments',
                'userRegistrationsByDay',
                'visitors',
                'visitorRegistrationsByDay',
                'appointmentsByDay'
            ));            
        }

        public function create()
        {
            return view('admin.add');
        }

        public function appointments()
        {
            $appointments = Appointment::all(); 
            $approvedAppointments = Appointment::where('status', 'approved')->get(); 
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

    if ($user->role !== $request->role) {
        DB::table('user_role_changes')->insert([
            'user_id' => $user->id,
            'old_role' => $user->role,
            'new_role' => $request->role,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

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
            $search = $request->query('search');

            if ($search) {
                $employees = DB::table('organization')
                    ->where('name', 'like', '%' . $search . '%')
                    ->orWhere('position', 'like', '%' . $search . '%')
                    ->get();
            } else {
                $employees = DB::table('organization')->get();
            }

            return view('admin.employees', compact('employees'));
        }

        public function storeEmployee(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
            ]);

            DB::table('organization')->insert([
                'name' => $request->name,
                'position' => $request->position,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

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

    public function notifications()
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

        $completedAppointments = Appointment::where('status', 'completed')
            ->orderByDesc('updated_at')
            ->get();

        return view('admin.adminnotification', compact(
            'visitorNotifications',
            'pastAppointments',
            'completedAppointments'
        ));
    }

    public function adminVisitorLogs()
    {
        $visitors = Visitor::orderBy('visit_time', 'desc')->get();
        return view('admin.adminvisitorlogs', compact('visitors'));
    }

    public function analytics()
{
    $sameVisitorMultipleTimes = Visitor::select('full_name', DB::raw('count(*) as visits'))
    ->whereDate('visit_time', '=', now()->toDateString()) 
    ->groupBy('full_name') 
    ->havingRaw('count(*) > 1') 
    ->get();

    $hostsNotResponding = Appointment::select('host', DB::raw('count(*) as pending_count'))
        ->where('status', 'pending')
        ->groupBy('host')
        ->get();    

        $excessiveRejections = DB::table('appointments')
        ->select('host', DB::raw('count(*) as rejections'))
        ->where('status', 'rejected')
        ->groupBy('host')
        ->havingRaw('count(*) > 2')
        ->get();
    

    $failedLogins = DB::table('login_attempts')
    ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as attempts'))
    ->where('status', 'failed')
    ->groupBy(DB::raw('DATE(created_at)'))
    ->orderBy('date', 'asc')
    ->get();

    $roleChanges = DB::table('user_role_changes')
        ->orderByDesc('created_at')
        ->limit(5)
        ->get();

    return view('admin.analytics', compact(
        'sameVisitorMultipleTimes',
        'hostsNotResponding',
        'excessiveRejections',
        'failedLogins',
        'roleChanges'
    ));
}
    }

