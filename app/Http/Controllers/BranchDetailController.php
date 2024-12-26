<?php

namespace App\Http\Controllers;
use App\Models\Branch;
use App\Models\Department;
use App\Models\BranchDetail;
use Illuminate\Http\Request;

class BranchDetailController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = BranchDetail::query();  
    

        if (!empty($search)) {
            $query->whereHas('branch', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->orWhereHas('department', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });

        }
    
        $branchDetails = $query->with(['branch', 'department'])
                                 ->paginate(10);
    
        return view('admin.branchdetails.index', compact('branchDetails'));
    }
    
    
    public function create()
    {   
        $branchs = Branch::all();
        $departments = Department::all();

        $branchDetail =BranchDetail::all();
        return view('admin.branchdetails.create', compact('branchs','departments', 'branchDetail'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'department_id' => 'required|exists:departments,id',
        ]);

      
        $branchDetail = new BranchDetail();
        $branchDetail->branch_id = $request->branch_id;
        $branchDetail->department_id = $request->department_id;
        $branchDetail->save();


        return redirect()->route('branchdetail.index')->with('success', 'Branch Detail added successfully.');
    }

    public function show(string $id)
    {
        return view('admin.branchdetails.show', compact('branchdetail'));

    }
    public function edit(string $id)
    {
        
        $branchs = Branch::all();
        $departments = Department::all();
        $branchdetail = BranchDetail::findOrFail($id);
        return view('admin.branchdetails.edit',compact('branchs', 'departments',  'branchdetail'));
    }
    public function update($id, Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'department_id' => 'required|exists:departments,id',
        ]);
    
        $branchDetail = BranchDetail::find($id);
    
        if (!$branchDetail) {
            return redirect()->route('branchdetail.index')->with('error', 'Employee not found.');
        }
    
        $branchDetail->branch_id = $request->branch_id;
        $branchDetail->department_id = $request->department_id;

    
        $branchDetail->update();
    
        if ($branchDetail->update()) {
            return redirect()->route('branchdetail.index')->with('success', 'Branch Detail updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update Branch Detail.');
        }
    }
    

public function destroy(string $id)
{
    $branchDetail = BranchDetail::findOrFail($id);
    $branchDetail->delete();

    return redirect()->route('branchdetail.index')->with('success', 'branch Detail deleted successfully.');
}


public function getDepartments(Request $request)
{
    $branchId = $request->input('branch_id');


    $departments = Department::where('branch_id', $branchId)->get(['id', 'name']); 
    return response()->json($departments);
}


}
