<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Http\Requests\StoreRankRequest;
use App\Http\Requests\UpdateRankRequest;
use Illuminate\Http\Request;

class RankController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $rank = Rank::when($search, function($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('rank', 'like', '%' . $search . '%');
        })
        ->latest()
        ->paginate(10)
        ->appends(['search' => $search]);
        
        return view('admin.rank.index', compact('rank'));
    }

    
    public function create()
    {
        return view('admin.rank.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:ranks',
            'rank' => 'required|string|max:255',
        ]);
    

        $rank = new Rank();
        $rank->name = $request->name;
        $rank->rank = $request->rank;
        $rank->save();
    
        return redirect()->route('rank.index')->with('success', 'Rank added successfully.');
    }


    public function show(Rank $rank)
    {
        //
    }

    public function edit(string $id)
    {
        $rank = Rank::findOrFail($id);
        return view('admin.rank.edit',compact('rank'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:ranks,name,' . $id,
            'rank' => 'required|string|max:255',
        ]);

        $rank = Rank::findOrFail($id);
        $rank->update([
            'name' => $request->name,
            'rank' => $request->rank,
        ]);

            return redirect()->route('rank.index')->with('success', 'Rank updated successfully.');
    }
    public function destroy(string $id)
    {
        $rank = Rank::findOrFail($id);
        $rank->delete();

        return redirect()->route('rank.index')->with('success', 'Rank deleted successfully.');
    }
}
