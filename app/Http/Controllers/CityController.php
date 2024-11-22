<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $cities = City::
        when($search, function($query) use ($search){
            return $query->where('name', 'ilike', '%' . $search . '%');
        })
        ->paginate(10)
        ->appends(['search' => $search]);
        return view('admin.city.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.city.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $request->validate(
            [
                'name'=> 'required|unique:cities,name',
            ]
            );
            City::create([
                'name'=>$request->name,
            ]);

            return redirect()->route('cities.index')->with('success', 'City added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $city = City::findOrFail($id);
        return view('admin.city.edit',compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name'=> 'required|unique:cities,name,' .$id,
            ]
            );
            $city = City::findOrFail($id);
            $city->update([
                'name'=>$request->name,
            ]);

            return redirect()->route('cities.index')->with('success', 'City updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return redirect()->route('cities.index')->with('success', 'City deleted successfully.');
    }
}

