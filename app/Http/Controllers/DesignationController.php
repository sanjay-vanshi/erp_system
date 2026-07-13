<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDesignationRequest;
use App\Http\Requests\UpdateDesignationRequest;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DesignationController extends Controller implements HasMiddleware
{
    // giving permission
    public static function middleware(): array
    {
        return [

            new Middleware(
                'permission:view designations',
                only: ['index', 'show']
            ),

            new Middleware(
                'permission:create designations',
                only: ['create', 'store']
            ),

            new Middleware(
                'permission:edit designations',
                only: ['edit', 'update']
            ),

            new Middleware(
                'permission:delete designations',
                only: ['destroy']
            ),

        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Designation::query();

        if ($request->search) {

            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                    ->orWhere('description', 'like', '%'.$request->search.'%');
            });
        }

        $designations = $query->orderBy('id', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('designations.index', compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('designations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDesignationRequest $request)
    {

        Designation::create($request->validated());

        return redirect()
            ->route('designations.index')
            ->with('success', 'Designation created successfully.');
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
    public function edit(Designation $designation)
    {
        return view('designations.edit', compact('designation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDesignationRequest $request, Designation $designation)
    {
        $designation->update($request->validated());

        return redirect()
            ->route('designations.index')
            ->with('success', 'Designation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designation $designation)
    {
        $designation->delete();

        return redirect()
            ->route('designations.index')
            ->with('success', 'Designation deleted successfully.');
    }
}
