<?php

namespace App\Http\Controllers;
use App\Models\EmployeeDetail;
use App\Http\Requests\StoreEmployeeDetailRequest;
use App\Http\Requests\UpdateEmployeeDetailRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\BranchDetail;
use App\Models\Duty;
use App\Models\Rank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class EmployeeDetailController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search'); 
        $query = EmployeeDetail::query();  

        if (!empty($search)) {
            $query->whereHas('branch', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->orWhereHas('department', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->orWhereHas('rank', function ($q) use ($search) {
                $q->where('rank', 'like', "%{$search}%");
            })
            ->orWhereHas('employees', function ($q) use ($search) {
                $q->where('employees', 'like', "%{$search}%");
            });
        }
    
        $employeeDetails = $query->with(['branch', 'department', 'duties', 'rank','employees'])
                                 ->paginate(10);
    
        return view('admin.employeedetails.index', compact('employeeDetails'));

        
        
    }
    
    public function create(Request $request)
    {
        $branches = Branch::with('departments')->get();
        $dutytimes = Duty::all();
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
    
        return view('admin.employeedetails.create', compact(
            'branches',
            'departments',
            'ranks',
            'dutytimes',
            'employees',

        ));
    }
    
    
    public function store(Request $request)
    {

        Log::info($request->all());
    
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,employee_id', 
            'branch_id' => 'required|exists:branches,id', 
            'department_id' => 'required|exists:departments,id', 
            'rank_id' => 'required|exists:ranks,id',  
            'duty_time_id' => 'required|exists:duties,id', 
            'enroll_date' => 'required|date',
            'permanent_date' => 'required|date',
            'emp_photos' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'isTraining' => 'required|boolean',
        ]);
    
        Log::info('Validated data: ', $validated);

    

        try {

            $employeeDetail = new EmployeeDetail();
    
            $employeeDetail->employee_id = $validated['employee_id'];
            $employeeDetail->branch_id = $validated['branch_id'];
            $employeeDetail->department_id = $validated['department_id'];
            $employeeDetail->rank_id = $validated['rank_id'];
            $employeeDetail->duty_time_id = $validated['duty_time_id'];
            $employeeDetail->enroll_date = $validated['enroll_date'];
            $employeeDetail->permanent_date = $validated['permanent_date'];
            $employeeDetail->isTraining = $validated['isTraining'];



            if ($request->hasFile('emp_photos')) {
                $filename = time() . '.' . $request->emp_photos->extension();
                $request->emp_photos->move(public_path('images/employees'), $filename);
                $employeeDetail->emp_photos = $filename;
            }

    
            try{
                $employeeDetail->save();

            }catch(Exception $e){
                dd($e);
            }

            return redirect()->route('employeedetail.index')->with('success', 'Employee added successfully!');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'An error occurred while creating the employee.');
        }
    }
    
    
    
    public function show(string $id)
    {
        return view('admin.employeedetails.show', compact('employeedetail'));

    }



    public function edit($id, Request $request)
    {

                $branches = Branch::with('departments')->get(); 
                $dutytimes = Duty::all();
                $employees = Employee::all();
            
                $departments = collect();
                $ranks = collect(); 
                $employeedetail = EmployeeDetail::findOrFail($id);
            

                if ($request->filled('branch_id')) {
                    $branch = $branches->find($request->branch_id); 
                    $departments = $branch ? $branch->departments : collect();
                }
            
                if ($request->filled('department_id')) {
                    $department = Department::with('ranks')->find($request->department_id);
                    $ranks = $department ? $department->ranks : collect();
                }

                return view('admin.employeedetails.edit', compact(
                    'branches',
                    'departments',
                    'ranks',
                    'dutytimes',
                    'employees',
                    'employeedetail'
                ));

    }
    

 
public function update($id, Request $request)
{
    $validated = $request->validate([
        'employee_id' => 'exists:employees,employee_id',
        'branch_id' => 'required|exists:branches,id',
        'department_id' => 'required|exists:departments,id',
        'rank_id' => 'required|exists:ranks,id',
        'duty_time_id' => 'required|exists:duties,id',
        'enroll_date' => 'required|date',
        'permanent_date' => 'required|date',
        'emp_photos' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'isTraining' => 'required|boolean',
    ]);

    $employeeDetail = EmployeeDetail::find($id);

    if (!$employeeDetail) {
        return redirect()->route('employeedetail.index')->with('error', 'Employee not found.');
    }

    $employeeDetail->employee_id = $validated['employee_id'];
    $employeeDetail->branch_id = $validated['branch_id'];
    $employeeDetail->department_id = $validated['department_id'];
    $employeeDetail->rank_id = $validated['rank_id'];
    $employeeDetail->duty_time_id = $validated['duty_time_id'];
    $employeeDetail->enroll_date = $validated['enroll_date'];
    $employeeDetail->permanent_date = $validated['permanent_date'];
    $employeeDetail->isTraining = $validated['isTraining'];


    if ($request->hasFile('emp_photos')) {
        if ($employeeDetail->emp_photos && file_exists(public_path('images/employees' . $employeeDetail->emp_photos))) {
            unlink(public_path('images/employees' . $employeeDetail->emp_photos));
        }

        $imgName = time() . '.' . $request->emp_photos->extension();
        $request->emp_photos->move(public_path('images/employees'), $imgName);
        $employeeDetail->emp_photos = $imgName;
    }

    if ($employeeDetail->update()) {
        return redirect()->route('employeedetail.index')->with('success', 'Employee Detail updated successfully.');
    } else {
        return redirect()->back()->with('error', 'Failed to update Employee Detail.');
    }
}


    public function destroy(string $id)
    {
        $employee = EmployeeDetail::findOrFail($id);
        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Employee Detail deleted successfully.');
    }
    
}
