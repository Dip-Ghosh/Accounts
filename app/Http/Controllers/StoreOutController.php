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
            ->join('product_types','product_types.id','=','store_outs.product_type_id')
            ->join('products','products.id','=','store_outs.product_id')
            ->select('store_outs.*','product_types.name as Tname','products.name as Pname')
            ->get();

        return view('storeOut.list',compact('storeOuts'));
    }


    public function create()
    {
        $product_types=ProductType::all();
        return view('storeOut.create',compact('product_types'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'product_type_id'=>'required',
            'product_id'=>'required',
            'quantity'=>'required',

        ]);


        StoreOut::create([
            'product_type_id' => $request->product_type_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'note' => $request->note,
            'date' =>  $request->date,
        ]);
        return redirect('storeOut')->with('success', 'Store Out  created successfully.');
    }


    public function show(StoreOut $storeOut)
    {
        //
    }


    public function edit($id)
    {
        $storeOuts = StoreOut::find($id);
        $product_types = ProductType::all();
        $products= Product::all();
        return view('storeOut.edit', compact('storeOuts','product_types','products'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'product_type_id'=>'required',
            'product_id'=>'required',
            'quantity'=>'required',

        ]);
        $storeOut= StoreOut::find($id);
        $storeOut->product_type_id = $request->product_type_id;
        $storeOut->product_id = $request->product_id;
        $storeOut ->quantity = $request->quantity;
        $storeOut->note = $request->note;
        $storeOut->save();

        return redirect('storeOut')->with('success', 'Store Out updated successfully.');
    }


    public function destroy($id)
    {
        $storeOut = StoreOut::find($id);
        $storeOut->delete();
        return redirect()->back()->with('success', 'Store Out deleted successfully.');
    }

    public function findProduct($id)
    {

        $products = Product::where('product_type','=',$id)->pluck('name','id');
        return response()->json($products);
    }
}
