<?php
namespace App\Http\Controllers;

use App\Models\Duty;
use Illuminate\Http\Request;

class DutyController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $duties = Duty::when($search, function($query) use ($search) {
            return $query->where('duty', 'ilike', '%' . $search . '%');
        })
        ->paginate(10)
        ->appends(['search' => $search]);

        return view('admin.duty.index', compact('duties'));
    }

    public function create()
    {
        return view('admin.duty.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'duty' => 'required|unique:duties,duty', // 
            'status' => 'required|string|max:255',
        ]);

        $duty = new Duty();
        $duty->duty = $request->duty;
        $duty->status = $request->status;
        $duty->save();

        return redirect()->route('duties.index')->with('success', 'Duty created successfully.');
    }

    public function edit($id)
    {
        $duty = Duty::findOrFail($id);
        return view('admin.duty.edit', compact('duty'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'duty' => 'required|unique:duties,duty,' .$id,
            'status' => 'required|string|max:255',
        ]);

        $duty = Duty::findOrFail($id);
        $duty->duty = $request->duty;
        $duty->status = $request->status;
        $duty->update();

        return redirect()->route('duties.index')->with('success', 'Duty updated successfully.');
    }

    public function destroy($id)
    {
        $duty = Duty::findOrFail($id);
        $duty->delete();

        return redirect()->route('duties.index')->with('success', 'Duty deleted successfully.');
    }
}

