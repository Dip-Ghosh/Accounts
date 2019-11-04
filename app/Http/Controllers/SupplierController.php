<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function index()
    {

        $suppliers = Supplier::paginate(10);
        return view('suppliers.list', compact('suppliers'));
    }


    public function create()
    {
        return view('suppliers.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required',

        ]);


        Supplier::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'address' => $request->address,

        ]);


        return redirect('supplier')->with('success', 'Supplier  created successfully.');

    }


    public function show(Supplier $supplier)
    {
        //
    }


    public function edit($id)
    {
        $suppliers = Supplier::find($id);

        return view('suppliers.edit', compact('suppliers'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required',

        ]);

        $suppliers = Supplier::find($id);
        $suppliers->name = $request->name;
        $suppliers->mobile = $request->mobile;
        $suppliers->address = $request->address;
        $suppliers->save();
        return redirect('supplier')->with('success', 'Supplier  Updated successfully.');
    }


    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect()->back()->with('success', 'Supplier  Deleted successfully.');

    }
}
