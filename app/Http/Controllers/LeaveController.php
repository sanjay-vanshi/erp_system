<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use App\Models\Employee;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of leaves.
     */
    public function index(Request $request)
    {
        $query = Leave::with('employee');


        // Search
        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->whereHas('employee', function ($employee) use ($request) {

                    $employee->where('employee_code', 'like', '%' . $request->search . '%')
                             ->orWhere('first_name', 'like', '%' . $request->search . '%')
                             ->orWhere('last_name', 'like', '%' . $request->search . '%');

                })
                ->orWhere('leave_type', 'like', '%' . $request->search . '%')
                ->orWhere('status', 'like', '%' . $request->search . '%');

            });
        }
 
        // Status Filter
if ($request->status) {

    $query->where('status', $request->status);

}

        $leaves = $query->orderBy('id', 'DESC')
                        ->paginate(10)
                        ->withQueryString();


        return view('leaves.index', compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::orderBy('first_name')->get();

        return view('leaves.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeaveRequest $request)
    {


    $totalDays = Carbon::parse($request->from_date)
    ->diffInDays(Carbon::parse($request->to_date)) + 1;
         Leave::create([

        'employee_id' => $request->employee_id,

        'leave_type' => $request->leave_type,

        'from_date' => $request->from_date,

        'to_date' => $request->to_date,

        'total_days' => $totalDays,

        'reason' => $request->reason,

        'status' => 'pending',

    ]);


    return redirect()
        ->route('leaves.index')
        ->with('success', 'Leave request submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leaf)
{
    $leaf->load([
        'employee.department',
        'employee.designation',
        'approver'
    ]);

    return view('leaves.show', [
        'leave' => $leaf
    ]);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leaf)
{
    
    $employees = Employee::orderBy('first_name')->get();

    return view('leaves.edit',[
        'leave'=> $leaf,
        'employees'=> $employees
    ]);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeaveRequest $request, Leave $leaf)
    {
        $leaf->update([

        'employee_id' => $request->employee_id,

        'leave_type' => $request->leave_type,

        'from_date' => $request->from_date,

        'to_date' => $request->to_date,

        'total_days' => $request->total_days,

        'reason' => $request->reason,

        'status' => $request->status,

        'remarks' => $request->remarks,

    ]);


    return redirect()
        ->route('leaves.index')
        ->with('success', 'Leave updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Leave $leave)
{
    $leave->delete();

    return redirect()
        ->route('leaves.index')
        ->with('success', 'Leave deleted successfully.');
}
// here all method for leave approved or reject or panding 
public function approve(Leave $leaf)
{
    $leaf->update([
        'status' => 'approved',
        'approved_by' => auth()->id(),
    ]);


    return redirect()
        ->route('leaves.index')
        ->with('success', 'Leave approved successfully.');
}



public function reject(Request $request, Leave $leaf)
{
    $request->validate([
        'remarks' => 'required|string|max:500',
    ]);


    $leaf->update([
        'status' => 'rejected',
        'approved_by' => auth()->id(),
        'remarks' => $request->remarks,
    ]);


    return redirect()
        ->route('leaves.index')
        ->with('success', 'Leave rejected successfully.');
}

// reject form 
public function rejectForm(Leave $leaf)
{
    return view('leaves.reject', [
        'leave' => $leaf
    ]);
}


}
