<?php

namespace App\Http\Controllers;

use App\Models\PayCode;
use Illuminate\Http\Request;

class PayCodeController extends Controller
{
    public function index()
    {
        $paycodes = PayCode::all();
        return view('admin.paycode.index', compact('paycodes'));
    }

    public function create()
    {
        return view('admin.paycode.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:pay_codes,code',
            'amount' => 'required|integer|min:0',
        ]);

        PayCode::create($request->all());

        return redirect()->route('paycodes.index')->with('success', 'PayCode added successfully.');
    }

    public function show($id)
    {
        $paycode = PayCode::findOrFail($id);
        return view('admin.paycode.show', compact('paycode'));
    }

    public function edit($id)
    {
        $paycode = PayCode::findOrFail($id);
        return view('admin.paycode.edit', compact('paycode'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|unique:pay_codes,code,' . $id,
            'amount' => 'required|integer|min:0',
        ]);

        $paycode = PayCode::findOrFail($id);
        $paycode->update($request->all());

        return redirect()->route('paycodes.index')->with('success', 'PayCode updated successfully.');
    }


    public function destroy($id)
    {
        $paycode = PayCode::findOrFail($id);
        $paycode->delete();

        return redirect()->route('paycodes.index')->with('success', 'PayCode deleted successfully.');
    }
}
