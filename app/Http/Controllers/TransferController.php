<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Rank;
use App\Models\Employee;
use App\Models\Transfer;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index()
    {

        $transfers = Transfer::with(['employee', 'branch', 'department', 'rank'])->paginate(10);
        return view('admin.transfer.index', compact('transfers'));
    }

    public function create(Request $request)
    {

        $branches = Branch::with('departments')->get();
        $employees = Employee::all();
        $departments = collect();
        $ranks = collect(); 
    
        if ($request->filled('branch_id')) {
            $branch = $branches->find($request->branch_id);
            $departments = $branch ? $branch->departments : collect();
        }
    
        if ($request->filled('department_id')) {
            $department = Department::with('ranks')->find($request->department_id);
            $ranks = $department ? $department->ranks : collect();
        }

        return view('admin.transfer.create', compact(
            'branches',
            'departments',
            'ranks',
            'employees'
        ));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'branch_id' => 'required|exists:branches,id',
            'department_id' => 'required|exists:departments,id',
            'rank_id' => 'required|exists:ranks,id',
            'transfer_date' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        try {
            $transfers = new Transfer();
    
            $transfers->employee_id = $validated['employee_id'];
            $transfers->branch_id = $validated['branch_id'];
            $transfers->department_id = $validated['department_id'];
            $transfers->rank_id = $validated['rank_id'];
            $transfers->transfer_date = $validated['transfer_date'];
            $transfers->status = $validated['status'];
            $transfers->save();
            return redirect()->route('transfers.index')->with('success', 'Employee transfer history created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating transfer: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the transfer.');
        }
    }

    public function edit($id, Request $request)
    {

        $transfer = Transfer::findOrFail($id);
        $employees = Employee::all();
        $branches = Branch::all();
        $departments = Department::all();
        $ranks = Rank::all();


        $filteredDepartments = collect();
        $filteredRanks = collect();

        if ($request->filled('branch_id')) {
            $branch = $branches->find($request->branch_id);
            $filteredDepartments = $branch ? $branch->departments : collect();
        }

        if ($request->filled('department_id')) {
            $department = Department::with('ranks')->find($request->department_id);
            $filteredRanks = $department ? $department->ranks : collect();
        }


        return view('admin.transfer.edit', compact('transfer', 'employees', 'branches', 'departments', 'ranks', 'filteredDepartments', 'filteredRanks'));
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'branch_id' => 'required|exists:branches,id',
            'department_id' => 'required|exists:departments,id',
            'rank_id' => 'required|exists:ranks,id',
            'transfer_date' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        try {
            $transfer = Transfer::findOrFail($id);

            $transfer->update($validated);

            return redirect()->route('transfers.index')->with('success', 'Employee transfer history updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating transfer: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating the transfer.');
        }
    }

    public function destroy($id)
    {
        try {

            $transfer = Transfer::findOrFail($id);
            $transfer->delete();

            return redirect()->route('transfers.index')->with('success', 'Employee transfer history deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting transfer: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while deleting the transfer.');
        }
    }
}
