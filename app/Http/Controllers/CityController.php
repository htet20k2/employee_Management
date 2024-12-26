<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{

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


    public function create()
    {
        return view('admin.city.create');
    }


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

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $city = City::findOrFail($id);
        return view('admin.city.edit',compact('city'));
    }

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


    public function destroy(string $id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return redirect()->route('cities.index')->with('success', 'City deleted successfully.');
    }
}

