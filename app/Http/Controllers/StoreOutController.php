<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductType;
use App\StoreOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreOutController extends Controller
{

    public function index()
    {
        $storeOuts=DB::table('store_outs')
            ->join('customers','store_outs.customer_info','=','customers.mobile')
            ->select('store_outs.*','customers.name')
            ->get();

        return view('storeOut.list',compact('storeOuts'));
    }


    public function create()
    {
        return view('storeOut.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'invoice_no' => 'required',
            'customer_info' => 'required',

        ]);

         StoreOut::create([
            'invoice_no' => $request->invoice_no,
            'customer_info' => $request->customer_info,
            'note' => $request->note,
            'date' => $request->date,
        ]);
        return redirect('storeOut')->with('success', 'Store Out  created successfully.');
    }




    public function edit($id)
    {
        $storeOuts = StoreOut::find($id);

        return view('storeOut.edit', compact('storeOuts'));
    }


    public function update(Request $request, $id)
    {
       // dd($request->all());
        $request->validate([
            'invoice_no' => 'required',
            'customer_info' => 'required',

        ]);

        $storeOut= StoreOut::find($id);

        $storeOut->invoice_no = $request->invoice_no;
        $storeOut->customer_info = $request->customer_info;
        $storeOut->note = $request->note;
        $storeOut->date = $request->date;
        $storeOut->save();

        return redirect('storeOut')->with('success', 'Store Out updated successfully.');
    }


    public function destroy($id)
    {
        $storeOut = StoreOut::find($id);
        $storeOut->delete();
        return redirect()->back()->with('success', 'Store Out deleted successfully.');
    }



}
