<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;


class ActivityLogController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [

            new Middleware(
                'permission:view activity logs',
                only: ['index', 'show']
            ),

        ];
    }


   public function index(Request $request)
{
    $query = ActivityLog::with('user');


    // Search
    if ($request->search) {

        $query->where(function ($q) use ($request) {

            $q->where('description', 'like', '%'.$request->search.'%')
                ->orWhere('module', 'like', '%'.$request->search.'%')
                ->orWhere('action', 'like', '%'.$request->search.'%');

        });

    }


    // User Filter
    if ($request->user_id) {

        $query->where('user_id', $request->user_id);

    }


    // Module Filter
    if ($request->module) {

        $query->where('module', $request->module);

    }


    // Action Filter
    if ($request->action) {

        $query->where('action', $request->action);

    }


    // Date Filter
    if ($request->date) {

        $query->whereDate('created_at', $request->date);

    }


    $activityLogs = $query->latest()
        ->paginate(10)
        ->withQueryString();


    $users = User::orderBy('name')->get();


    $modules = ActivityLog::select('module')
        ->distinct()
        ->orderBy('module')
        ->pluck('module');


    $actions = ActivityLog::select('action')
        ->distinct()
        ->orderBy('action')
        ->pluck('action');


    return view('activity-logs.index', compact(
        'activityLogs',
        'users',
        'modules',
        'actions'
    ));
}


   public function show(ActivityLog $activityLog)
{
    $activityLog->load('user');

    return view('activity-logs.show', compact('activityLog'));
}
}