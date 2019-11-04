<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
        $customers = Customer::paginate(10);
        return view('customers.list', compact('customers'));
    }


    public function create()
    {
        return view('customers.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required',

        ]);


        Customer::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,

        ]);


        return redirect('customer')->with('success', 'Customers  created successfully.');

    }




    public function edit($id)
    {
        $customers = Customer::find($id);

        return view('customers.edit', compact('customers'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required',

        ]);

        $customers = Customer::find($id);
        $customers->name = $request->name;
        $customers->mobile = $request->mobile;
        $customers->email  = $request->email;
        $customers->save();
        return redirect('customer')->with('success', 'Customers  Updated successfully.');
    }


    public function destroy($id)
    {
        $customers = Customer::find($id);
        $customers->delete();
        return redirect()->back()->with('success', 'Customers  Deleted successfully.');

    }
}
