<?php

namespace App\Http\Controllers;

use App\Customer;
use App\ItemOut;
use App\Product;
use App\StoreOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreOutController extends Controller
{

    public function index()
    {
        $storeOuts=DB::table('store_outs')
            ->join('customers','store_outs.customer_info','=','customers.mobile')
            ->join('item_outs', 'store_outs.id', '=', 'item_outs.storing_out')
            ->select('store_outs.*','customers.name', DB::raw('SUM(item_outs.quantity) As Total_quantity'))
            ->groupBy('store_outs.id')
            ->get();

        return view('storeOut.list',compact('storeOuts'));
    }


    public function create()
    {
        $products = Product::all();
        return view('storeOut.create',compact('products'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'invoice_no' => 'required',
            'customer_info' => 'required',

        ]);

        $storeOuts= StoreOut::create([
            'invoice_no' => $request->invoice_no,
            'customer_info' => $request->customer_info,
            'note' => $request->note,
            'date' => $request->date,
        ]);


        $count = count($request->input('product_id'));

        for ($i = 0; $i < $count; $i++) {
            ItemOut::create([
                'storing_out' => $storeOuts->id,
                'product_id' => $request->product_id[$i],
                'quantity' => $request->quantity[$i],
                'price' => $request->price[$i],
            ]);
        }
        return redirect('storeOut')->with('success', 'Store Out  created successfully.');
    }



    public function edit($id)
    {
        $storeOuts = StoreOut::find($id);
        $items = ItemOut::where('storing_out','=',$id)->get();
        $products = Product::all();
        $customers = Customer::all();
        return view('storeOut.edit', compact('storeOuts','items','customers','products'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'invoice_no' => 'required',

        ]);

        $i=ItemOut::where('storing_out','=',$id);
        $i->delete();

        $storeOut= StoreOut::find($id);
        $storeOut->invoice_no = $request->invoice_no;
        $storeOut->customer_info = $request->customer_info;
        $storeOut->note = $request->note;
        $storeOut->date = $request->date;
        $storeOut->save();

        $count = count($request->input('product_id'));

        for ($i = 0; $i < $count; $i++) {
            ItemOut::create([
                'storing_out' => $storeOut->id,
                'product_id' => $request->product_id[$i],
                'quantity' => $request->quantity[$i],
                'price' => $request->price[$i],
            ]);
        }

        return redirect('storeOut')->with('success', 'Store Out updated successfully.');
    }


    public function destroy($id)
    {
        $items=  ItemOut::where('storing_out','=',$id);
        $items->delete();
        $storeOut = StoreOut::find($id);
        $storeOut->delete();
        return redirect()->back()->with('success', 'Store Out deleted successfully.');
    }



}
