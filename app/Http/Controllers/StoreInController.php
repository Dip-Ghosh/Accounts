<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductType;
use App\StoreIn;
use App\Items;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Phalcon\Logger\Item;
use Barryvdh\DomPDF\Facade as PDF;

class StoreInController extends Controller
{

    public function index()
    {
        $storeIns = DB::table('store_ins')
            ->join('suppliers', 'suppliers.id', '=', 'store_ins.supplier_id')
            ->join('items', 'store_ins.id', '=', 'items.storing_in')
            ->select('store_ins.*', 'suppliers.name as Sname', DB::raw('SUM(items.quantity) As Total_quantity'))
            ->groupBy('store_ins.id')
            ->paginate(10);

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
                'storing_in' => $storeIns->id,
                'product_id' => $request->product_id[$i],
                'quantity' => $request->quantity[$i],
                'price' => $request->price[$i],
            ]);
        }

        return redirect('storeIn')->with('success', 'Store In  created successfully.');
    }
    public function show($id)
    {

        $storeIns = StoreIn::find($id);


        $Items = DB::table('items')
            ->where('storing_in', '=', $id)
            ->join('products', 'products.id', '=', 'items.product_id')
            ->select('items.*', 'products.name as Pname')
            ->groupBy('items.id')
            ->get();

            //dd($Items);
            $suppliers=DB::table('store_ins')
            ->where('store_ins.id','=',$id)
            ->join('suppliers','store_ins.supplier_id','=','suppliers.id')
            ->select('store_ins.id','suppliers.name as sname','suppliers.address','suppliers.mobile')
            ->get();

            //dd($suppliers);
        return view('storeIn.view', compact('storeIns', 'Items','suppliers'));
    }

    public function edit($id)
    {
        $storeIns = StoreIn::find($id);
        $items = Items::where('storing_in','=',$id)->get();
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('storeIn.edit', compact('storeIns', 'items', 'products', 'suppliers'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'invoice_no' => 'required',
            'supplier_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',

        ]);

        $i=Items::where('storing_in','=',$id);
        $i->delete();
        $storeIn = StoreIn::find($id);
        $storeIn->invoice_no = $request->invoice_no;
        $storeIn->supplier_id = $request->supplier_id;
        $storeIn->note = $request->note;
        $storeIn->date = $request->date;
        $storeIn->save();


        $count = count($request->input('product_id'));

        for ($i = 0; $i < $count; $i++) {
            Items::create([
                'storing_in' => $storeIn->id,
                'product_id' => $request->product_id[$i],
                'quantity' => $request->quantity[$i],
                'price' => $request->price[$i],
            ]);
        }

        return redirect('storeIn')->with('success', 'Store In updated successfully.');


    }

    public function destroy($id)
    {
        $items=  Items::where('storing_in','=',$id);
        $items->delete();
        $storeIn = StoreIn::find($id);
        $storeIn->delete();

        return redirect()->back()->with('success', 'Store In deleted successfully.');
    }

    public function download_Pdf($id)
    {

        $storeIns = StoreIn::find($id);


        $Items = DB::table('items')
            ->where('storing_in', '=', $id)
            ->join('products', 'products.id', '=', 'items.product_id')
            ->select('items.*', 'products.name as Pname')
            ->groupBy('items.id')
            ->get();

            //dd($Items);
            $suppliers=DB::table('store_ins')
            ->where('store_ins.id','=',$id)
            ->join('suppliers','store_ins.supplier_id','=','suppliers.id')
            ->select('store_ins.id','suppliers.name as sname','suppliers.address','suppliers.mobile')
            ->get();
        $pdf = PDF::loadView('storeIn.pdf', compact('storeIns','Items','suppliers'));

        return $pdf->download('storeInInvoice.pdf');
    }

}
