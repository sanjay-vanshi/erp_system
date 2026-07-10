<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;
        $role = $request->role;

        $query = User::with(['employee', 'role']);

        if ($search) {
            $query->where(function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('employee', function ($employeeQuery) use ($search) {

                        $employeeQuery->where('employee_code', 'like', "%{$search}%")
                            ->orWhere('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");

                    });

            });

        }

        if ($status) {

            $query->where('status', $status);

        }

        if ($role) {

            $query->where('role_id', $role);

        }

        $users = $query->latest()
            ->paginate(10)
            ->withQueryString();

        $roles = Role::where('status', 'Active')->get();

        return view('users.index', compact(
            'users',
            'roles'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::where('status', 'Active')
            ->doesntHave('user')
            ->orderBy('first_name')
            ->get();

        $roles = Role::where('status', 'Active')
            ->orderBy('name')
            ->get();

        return view('users.create', compact(
            'employees',
            'roles'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        $employee = Employee::findOrFail($data['employee_id']);

        $data['name'] = $employee->first_name.' '.$employee->last_name;

        User::create($data);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load([
            'employee.department',
            'employee.designation',
            'role',
        ]);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $employees = Employee::where('status', 'Active')
            ->where(function ($query) use ($user) {

                $query->doesntHave('user')
                    ->orWhere('id', $user->employee_id);

            })
            ->orderBy('first_name')
            ->get();

        $roles = Role::where('status', 'Active')
            ->orderBy('name')
            ->get();

        return view('users.edit', compact(
            'user',
            'employees',
            'roles'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        $employee = Employee::findOrFail($data['employee_id']);

        $data['name'] = $employee->first_name.' '.$employee->last_name;

        if (empty($data['password'])) {

            unset($data['password']);

        }

        $user->update($data);

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return redirect()
            ->route('users.index')
            ->with('error', 'Users cannot be deleted. Please mark the user as Inactive instead.');
    }
}
