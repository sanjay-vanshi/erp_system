<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHolidayRequest;
use App\Http\Requests\UpdateHolidayRequest;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class HolidayController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            new Middleware(
                'permission:view holidays',
                only: [
                    'index',
                    'show',
                ]
            ),

            new Middleware(
                'permission:create holidays',
                only: [
                    'create',
                    'store',
                ]
            ),

            new Middleware(
                'permission:edit holidays',
                only: [
                    'edit',
                    'update',
                ]
            ),

            new Middleware(
                'permission:delete holidays',
                only: [
                    'destroy',
                ]
            ),

        ];
    }

    /**
     * Display holiday list
     */
    public function index(Request $request)
    {

        $query = Holiday::query();

        // Search Holiday

        if ($request->search) {

            $query->where(
                'name',
                'like',
                '%'.$request->search.'%'
            );

        }

        // Year Filter

        if ($request->year) {

            $query->whereYear(
                'holiday_date',
                $request->year
            );

        }

        $holidays = $query
            ->latest('holiday_date')
            ->paginate(10)
            ->withQueryString();

        return view(
            'holidays.index',
            compact('holidays')
        );

    }

    /**
     * Create holiday form
     */
    public function create()
    {
        return view('holidays.create');
    }

    /**
     * Store holiday
     */
    public function store(StoreHolidayRequest $request)
    {

        Holiday::create(
            $request->validated()
        );

        return redirect()
            ->route('holidays.index')
            ->with(
                'success',
                'Holiday created successfully'
            );

    }

    /**
     * Show holiday
     */
    public function show(Holiday $holiday)
    {
        return view(
            'holidays.show',
            compact('holiday')
        );
    }

    /**
     * Edit form
     */
    public function edit(Holiday $holiday)
    {
        return view(
            'holidays.edit',
            compact('holiday')
        );
    }

    /**
     * Update holiday
     */
    public function update(
        UpdateHolidayRequest $request,
        Holiday $holiday
    ) {

        $holiday->update(
            $request->validated()
        );

        return redirect()
            ->route('holidays.index')
            ->with(
                'success',
                'Holiday updated successfully'
            );

    }

    /**
     * Delete holiday
     */
    public function destroy(Holiday $holiday)
    {

        $holiday->delete();

        return redirect()
            ->route('holidays.index')
            ->with(
                'success',
                'Holiday deleted successfully'
            );

    }
}
