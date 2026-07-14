<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller implements HasMiddleware
{
    // permissions giving

    public static function middleware(): array
    {
        return [

            new Middleware(
                'permission:view roles',
                only: ['index', 'show']
            ),

            new Middleware(
                'permission:create roles',
                only: ['create', 'store']
            ),

            new Middleware(
                'permission:edit roles',
                only: ['edit', 'update']
            ),

            new Middleware(
                'permission:delete roles',
                only: ['destroy']
            ),

        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $query = Role::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($status) {
            $query->where('status', $status);
        }

        $roles = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
{
    $permissions = Permission::orderBy('name')->get();

    return view('roles.create', compact('permissions'));
}

    /**
     * Store a newly created resource in storage.
     */
   public function store(StoreRoleRequest $request)
{
    $data = $request->validated();

    $role = Role::create($data);

    $role->permissions()->sync(
        $request->permissions ?? []
    );

    return redirect()
        ->route('roles.index')
        ->with('success', 'Role created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
{
    $permissions = Permission::orderBy('name')->get();

    return view('roles.edit', compact(
        'role',
        'permissions'
    ));
}

    /**
     * Update the specified resource in storage.
     */
  public function update(UpdateRoleRequest $request, Role $role)
{
    $data = $request->validated();

    $role->update($data);

    $role->permissions()->sync(
        $request->permissions ?? []
    );

    return redirect()
        ->route('roles.index')
        ->with('success', 'Role updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if ($role->users()->exists()) {

            return redirect()
                ->route('roles.index')
                ->with('error', 'This role cannot be deleted because it is assigned to one or more users.');
        }

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }
    // method for role permissions....

    public function permissions(Role $role)
    {
        $permissions = Permission::orderBy('name')->get();

        return view('roles.permissions', compact(
            'role',
            'permissions'
        ));
    }

    //  method for updatePermission for role...
    public function updatePermissions(Request $request, Role $role)
    {
        $role->permissions()->sync(
            $request->permissions ?? []
        );

        return redirect()
            ->route('roles.index')
            ->with(
                'success',
                'Permissions assigned successfully.'
            );
    }
}
