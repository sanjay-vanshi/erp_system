<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller implements HasMiddleware
{
    //   giving permissions
    public static function middleware(): array
    {
        return [

            new Middleware(
                'permission:view permissions',
                only: ['index', 'show']
            ),

            new Middleware(
                'permission:create permissions',
                only: ['create', 'store']
            ),

            new Middleware(
                'permission:edit permissions',
                only: ['edit', 'update']
            ),

            new Middleware(
                'permission:delete permissions',
                only: ['destroy']
            ),

        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Permission::query();

        // 🔍 Search
        if ($request->search) {

            $query->where('name', 'like', '%'.$request->search.'%');

        }

        // 🛡️ Guard Filter
        if ($request->guard_name) {

            $query->where('guard_name', $request->guard_name);

        }

        $permissions = $query->orderBy('id', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
