<?php

namespace App\Http\Controllers;

use App\Models\Casual;
use Illuminate\Http\Request;

class CasualController extends Controller
{

    public function index()
    {
        $casuals = Casual::with('employee')->get();
        return view('admin.casual.index', compact('casuals'));
    }


    public function create()
    {
        $employees = \App\Models\Employee::all();
        return view('admin.casual.create', compact('employees'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,employee_id',
            'formonth' => 'required|integer|min:1|max:12',
            'foryear' => 'required|integer|min:1|max:2100',
            'count' => 'required|integer|min:0',
            'istraining' => 'required|string',
        ]);
    
        Casual::create($request->all());
    
        return redirect()->route('casuals.index')->with('success', 'Casual added successfully.');
    }

 
    public function show(string $id)
    {
        $casual = Casual::with('employee')->findOrFail($id);
        return view('admin.casual.show', compact('casual'));
    }


    public function edit(string $id)
    {
        $casual = Casual::findOrFail($id);
        return view('admin.casual.edit', compact('casual'));
    }

  
    public function update(Request $request, string $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,employee_id', 
            'formonth' => 'required|integer|min:1|max:12',
            'foryear' => 'required|integer|min:1|max:2100',
            'count' => 'required|integer|min:0',
            'istraining' => 'required|string',
        ]);
    
        $casual = Casual::findOrFail($id);
        $casual->update($request->all());
    
        return redirect()->route('casuals.index')->with('success', 'Casual updated successfully.');
    }

    public function destroy(string $id)
    {
        $casual = Casual::findOrFail($id);
        $casual->delete();

        return redirect()->route('casuals.index')->with('success', 'Casual deleted successfully.');
    }
}
