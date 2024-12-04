<?php

namespace App\Http\Controllers;
use App\Models\Rank;
use App\Models\Department;
use App\Models\DepartmentDetail;
use Illuminate\Http\Request;

class DepartmentDetailController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search'); // Get search input.
        $query = DepartmentDetail::query();   // Initialize the query builder.
    
        // Include relationships in the query and filter with search.
        if (!empty($search)) {
            $query->whereHas('department', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->orWhereHas('rank', function ($q) use ($search) {
                $q->where('rank', 'like', "%{$search}%");
            });
        }
    
        // Fetch data with pagination.
        $departmentDetails = $query->with(['department', 'rank'])
                                 ->paginate(10);
    
        // Return to the view.
        return view('admin.departmentdetails.index', compact('departmentDetails'));
    }

    public function create()
    {   
        $departments = Department::all();
        $ranks = Rank::all();
        $departmentDetail = DepartmentDetail::all();
        return view('admin.departmentdetails.create', compact('departments','ranks', 'departmentDetail'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'department_id' => 'required|exists:departments,id', 
            'rank_id' => 'required|exists:ranks,id',
        ]);

      
        $departmentDetail = new DepartmentDetail();
        $departmentDetail->department_id = $request->department_id;
        $departmentDetail->rank_id = $request->rank_id;
        $departmentDetail->save();

        return redirect()->route('departmentdetail.index')->with('success', 'department Detail added successfully.');
    }

    public function show(string $id)
    {
        return view('admin.departmentdetails.show', compact('departmentdetail'));

    }

    public function edit(string $id)
    {
        
        $departments = Department::all();
        $ranks = Rank::all();
        $departmentdetail = DepartmentDetail::findOrFail($id);
        return view('admin.departmentdetails.edit',compact( 'departments',  'ranks', 'departmentdetail'));
    }
public function update($id, Request $request)
{
    $request->validate([
        'department_id' => 'required|exists:departments,id',
        'rank_id' => 'required|exists:ranks,id',
    ]);

    $departmentDetail = DepartmentDetail::find($id);

    if (!$departmentDetail) {
        return redirect()->route('departmentdetail.index')->with('error', 'department not found.');
    }

    $departmentDetail->department_id = $request->department_id;
    $departmentDetail->rank_id = $request->rank_id;

    $departmentDetail->update();

    if ($departmentDetail->update()) {
        return redirect()->route('departmentdetail.index')->with('success', 'department Detail updated successfully.');
    } else {
        return redirect()->back()->with('error', 'Failed to update department Detail.');
    }
}




    
}
