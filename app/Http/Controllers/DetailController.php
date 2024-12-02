<?php

namespace App\Http\Controllers;
use App\Models\Detail;
use App\Models\Employee;
use Illuminate\Http\Request;

class DetailController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $employees = Employee::when($search, function($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('sex', 'like', '%' . $search . '%')
                        ->orWhere('address', 'like', '%' . $search . '%')
                        ->orWhere('township', 'like', '%' . $search . '%')
                        ->orWhere('blood_type', 'like', '%' . $search . '%')
                        ->orWhere('other_qualification', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');

                        
        })
        ->paginate(10)
        ->appends(['search' => $search]);
        
        return view('admin.employeeReport.index', compact('employees'));
    }
    
}
