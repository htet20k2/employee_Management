<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Rank;
use App\Models\EmployeeDetail;
use App\Models\Employee;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TransferController extends Controller
{
    public function index()
    {
        $transfers = Transfer::with(['employee', 'employee.employeeDetails', 'employee.employeeDetails.branch', 'employee.employeeDetails.department', 'branch', 'department', 'rank'])->paginate(10);
        return view('admin.transfer.index', compact('transfers'));

    }

    public function create(Request $request)
    {
        $branches = Branch::with('departments')->get();
        $employeeDetails = EmployeeDetail::with(['branch', 'department'])->get();
        $departments = collect();
        $ranks = collect();
        $selectedEmployeeDetail = null;

        if ($request->filled('branch_id')) {
            $branch = $branches->find($request->branch_id);
            $departments = $branch ? $branch->departments : collect();
        }

        if ($request->filled('department_id')) {
            $department = Department::with('ranks')->find($request->department_id);
            $ranks = $department ? $department->ranks : collect();
        }

        if ($request->filled('employee_detail_id')) {
            $selectedEmployeeDetail = EmployeeDetail::with(['branch', 'department'])
                ->findOrFail($request->employee_detail_id);
        }

        return view('admin.transfer.create', compact(
            'branches',
            'departments',
            'ranks',
            'employeeDetails',
            'selectedEmployeeDetail'
        ));
    }

    public function store(Request $request)
    {

            $validated = $request->validate([
                'employee_detail_id' => 'required|exists:employee_details,id',
                'branch_id' => 'required|exists:branches,id',
                'department_id' => 'required|exists:departments,id',
                'rank_id' => 'required|exists:ranks,id',
                'transfer_date' => 'required|date',
                'status' => 'required|string|max:255',
            ]);
    


        $employeeDetail = EmployeeDetail::findOrFail($validated['employee_detail_id']);


        try {
            Transfer::create([
                'employee_id' => $validated['employee_detail_id'],
                'branch_id' => $validated['branch_id'],
                'department_id' => $validated['department_id'],
                'rank_id' => $validated['rank_id'],
                'transfer_date' => $validated['transfer_date'],
                'status' => $validated['status'],
            ]);


            return redirect()->route('transfers.index')->with('success', 'Employee transfer history created successfully.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'An error occurred while creating the transfer.');
        }
    }
    



    public function edit($id, Request $request)
    {
        $transfer = Transfer::findOrFail($id); 
        $branches = Branch::with('departments')->get();
        $employeeDetails = EmployeeDetail::with(['branch', 'department'])->get();
        $departments = collect();
        $ranks = collect();
        $selectedEmployeeDetail = null;


        if ($request->filled('branch_id')) {
            $branch = $branches->where('id', $request->branch_id)->first();
            $departments = $branch ? $branch->departments : collect();
        }

        if ($request->filled('department_id')) {
            $department = Department::with('ranks')->find($request->department_id);
            $ranks = $department ? $department->ranks : collect();
        }

        return view('admin.transfer.edit', compact(
            'transfer',
            'branches',
            'departments',
            'ranks',
            'employeeDetails',
            'selectedEmployeeDetail'
        ));
    }

    public function update(Request $request, $id)
    {
    

        try {
            $validated = $request->validate([
                'employee_id' => 'required|exists:employee_details,employee_id',
                'branch_id' => 'required|exists:branches,id',
                'department_id' => 'required|exists:departments,id',
                'rank_id' => 'required|exists:ranks,id',
                'transfer_date' => 'required|date',
                'status' => 'required|string|max:255',
            ]);

    
    
            $transfer = Transfer::findOrFail($id);
            $transfer->update($validated);
    
    
            return redirect()->route('transfers.index')->with('success', 'Transfer updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
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
