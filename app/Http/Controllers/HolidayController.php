<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{

    public function index()
    {
        $holidays = Holiday::all();
        return view('admin.holiday.index', compact('holidays'));
    }

    public function create()
    {
        return view('admin.holiday.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'holiday' => 'required|date|unique:holidays,holiday',
            'description' => 'required|string',
        ]);

        Holiday::create($request->all());

        return redirect()->route('holidays.index')->with('success', 'Holiday added successfully.');
    }

    public function show($id)
    {
        $holiday = Holiday::findOrFail($id);
        return view('admin.holiday.show', compact('holiday'));
    }

    public function edit($id)
    {
        $holiday = Holiday::findOrFail($id);
        return view('admin.holiday.edit', compact('holiday'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'holiday' => 'required|date|unique:holidays,holiday,' . $id,
            'description' => 'required|string',
        ]);

        $holiday = Holiday::findOrFail($id);
        $holiday->update($request->all());

        return redirect()->route('holidays.index')->with('success', 'Holiday updated successfully.');
    }

    public function destroy($id)
    {
        $holiday = Holiday::findOrFail($id);
        $holiday->delete();

        return redirect()->route('holidays.index')->with('success', 'Holiday deleted successfully.');
    }
}
