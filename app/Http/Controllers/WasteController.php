<?php

namespace App\Http\Controllers;

use App\Items;
use App\Product;
use App\StoreIn;
use App\Supplier;
use App\Waste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WasteController extends Controller
{

    public function index()
    {
        $storeIns = DB::table('store_ins')
            ->join('suppliers', 'suppliers.id', '=', 'store_ins.supplier_id')
            ->join('items', 'store_ins.id', '=', 'items.storing_id')
            ->select('store_ins.*', 'suppliers.name as Sname', DB::raw('SUM(items.quantity) As Total_quantity'))
            ->groupBy('store_ins.id')
            ->get();

        return view('storeIn.list', compact('storeIns'));
    }

    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();

        return view('storeIn.create', compact('products', 'suppliers'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'invoice_no' => 'required',
            'supplier_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',

        ]);


        $storeIns = StoreIn::create([
            'invoice_no' => $request->invoice_no,
            'supplier_id' => $request->supplier_id,
            'note' => $request->note,
            'date' => $request->date,
        ]);

        $count = count($request->input('product_id'));

        for ($i = 0; $i < $count; $i++) {
            Items::create([
                'storing_id' => $storeIns->id,
                'product_id' => $request->product_id[$i],
                'quantity' => $request->quantity[$i],
                'price' => $request->price[$i],
            ]);
        }

        return redirect('storeIn')->with('success', 'Store In  created successfully.');
    }


    public function edit($id)
    {
        $storeIns = StoreIn::find($id);
        $items = Items::where('storing_id','=',$id)->get();
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('storeIn.edit', compact('storeIns', 'items', 'products', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        dd($request->all());
        $request->validate([
            'invoice_no' => 'required',
            'supplier_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',

        ]);

        $i=Items::where('storing_id','=',$id);
        $i->delete();
        $storeIn = StoreIn::find($id);
        $storeIn->invoice_no = $request->invoice_no;
        $storeIn->supplier_id = $request->supplier_id;
        $storeIn->note = $request->note;
        $storeIn->date = $request->date;

        $storeIn->save();
        //dd($storeIns);


        $count = count($request->input('product_id'));

        for ($i = 0; $i < $count; $i++) {
            Items::create([
                'storing_id' => $storeIn->id,
                'product_id' => $request->product_id[$i],
                'quantity' => $request->quantity[$i],
                'price' => $request->price[$i],
            ]);
        }

        return redirect('storeIn')->with('success', 'Store In updated successfully.');


    }

    public function destroy($id)
    {
        $items=  Items::where('storing_id','=',$id);
        $items->delete();
        $storeIn = StoreIn::find($id);
        $storeIn->delete();

        return redirect()->back()->with('success', 'Store In deleted successfully.');
    }
}
