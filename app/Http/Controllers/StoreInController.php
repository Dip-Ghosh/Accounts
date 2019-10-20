<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductType;
use App\StoreIn;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreInController extends Controller
{

    public function index()
    {
        $storeIns=DB::table('store_ins')
            ->join('product_types','product_types.id','=','store_ins.product_type_id')
            ->join('products','products.id','=','store_ins.product_id')
            ->join('suppliers','suppliers.id','=','store_ins.supplier_id')
            ->select('store_ins.*','product_types.name as Tname','products.name as Pname','suppliers.name as Sname')
            ->get();

        return view('storeIn.list',compact('storeIns'));
    }

    public function create()
    {
        $product_types=ProductType::all();
        $products =Product::all();
        $suppliers = Supplier::all();

        return view('storeIn.create',compact('product_types','products','suppliers'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'product_type_id'=>'required',
            'product_id'=>'required',
            'supplier_id'=>'required',
            'quantity'=>'required',
            'purchase_price'=>'required',

        ]);


        StoreIn::create([
            'product_type_id' => $request->product_type_id,
            'product_id' => $request->product_id,
            'supplier_id' => $request->supplier_id,
            'quantity' => $request->quantity,
            'purchase_price' => $request->purchase_price,
            'note' => $request->note,
            'date' =>  $request->date,
        ]);
           return redirect('storeIn')->with('success', 'Store In  created successfully.');
    }

    public function show(StoreIn $storeIn)
    {

    }

    public function edit($id)
    {
        $storeIns = StoreIn::find($id);
        $product_types = ProductType::all();
        $products= Product::all();
        $suppliers =Supplier::all();
        return view('storeIn.edit', compact('storeIns','product_types','products','suppliers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_type_id'=>'required',
            'product_id'=>'required',
            'supplier_id'=>'required',
            'quantity'=>'required',
            'purchase_price'=>'required',

        ]);
        $storeIn= StoreIn::find($id);
        $storeIn->product_type_id = $request->product_type_id;
        $storeIn->product_id = $request->product_id;
        $storeIn->supplier_id = $request->supplier_id;
        $storeIn ->quantity = $request->quantity;
        $storeIn->purchase_price = $request->purchase_price;
        $storeIn->note = $request->note;
        $storeIn->save();

        return redirect('storeIn')->with('success', 'Store In updated successfully.');



    }

    public function destroy($id)
    {
        $storeIn = StoreIn::find($id);
        $storeIn->delete();
        return redirect()->back()->with('success', 'Store In deleted successfully.');
    }

    public function findProduct($id)
    {

        $products = Product::where('product_type','=',$id)->pluck('name','id');
        return response()->json($products);
    }
}
