<?php

namespace App\Http\Controllers;

use App\Items;
use App\Product;
use App\StoreIn;
use App\Supplier;
use App\Waste;
use App\WasteItems;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use PDF;
use Barryvdh\DomPDF\Facade as PDF;

class WasteController extends Controller
{

    //list
    public function index()
    {
        $wastes = DB::table('wastes')
            ->join('waste_items', 'wastes.id', '=', 'waste_items.waste_id')
            ->select('wastes.*', DB::raw('SUM(waste_items.quantity) As Total_quantity'))
            ->groupBy('wastes.id')
            ->paginate(10);

        return view('waste.list', compact('wastes'));
    }

    //create
    public function create()
    {
        $products = Product::all();
        return view('waste.create', compact('products'));
    }

    //store
    public function store(Request $request)
    {

        $request->validate([
            'invoice_no' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',

        ]);


        $wastes = Waste::create([
            'invoice_no' => $request->invoice_no,
            'note' => $request->note,
            'date' => $request->date,
        ]);

        $count = count($request->input('product_id'));

        for ($i = 0; $i < $count; $i++) {
            WasteItems::create([
                'waste_id' => $wastes->id,
                'product_id' => $request->product_id[$i],
                'quantity' => $request->quantity[$i],
                'price' => $request->price[$i],
            ]);
        }

        return redirect('waste')->with('success', 'Waste created successfully.');
    }

    //view
    public function show($id)
    {

        $wastes = Waste::find($id);
        $wasteItems = DB::table('waste_items')
            ->where('waste_id', '=', $id)
            ->join('products', 'products.id', '=', 'waste_items.product_id')
            ->select('waste_items.*', 'products.name')
            ->groupBy('waste_items.id')
            ->get();
//dd($wasteItems);
        return view('waste.view', compact('wastes', 'wasteItems'));
    }

    //edit
    public function edit($id)
    {
        $wastes = Waste::find($id);
        $items = WasteItems::where('waste_id', '=', $id)->get();
        $products = Product::all();
        return view('waste.edit', compact('wastes', 'items', 'products'));
    }

    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'invoice_no' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',

        ]);


        $i = WasteItems::where('waste_id', '=', $id);
        $i->delete();

        $wastes = Waste::find($id);
        $wastes->invoice_no = $request->invoice_no;
        $wastes->note = $request->note;
        $wastes->date = $request->date;
        $wastes->save();


        $count = count($request->input('product_id'));

        for ($i = 0; $i < $count; $i++) {
            WasteItems::create([
                'waste_id' => $wastes->id,
                'product_id' => $request->product_id[$i],
                'quantity' => $request->quantity[$i],
                'price' => $request->price[$i],
            ]);
        }

        return redirect('waste')->with('success', 'Waste updated successfully.');


    }

    //delete
    public function destroy($id)
    {
        $items = WasteItems::where('waste_id', '=', $id);
        $items->delete();
        $waste = Waste::find($id);
        $waste->delete();

        return redirect()->back()->with('success', 'Waste deleted successfully.');
    }



    public function download_Pdf($id)
     {

    $wastes = Waste::find($id);
    $wasteItems = DB::table('waste_items')
            ->where('waste_id', '=', $id)
            ->join('products', 'products.id', '=', 'waste_items.product_id')
            ->select('waste_items.*', 'products.name')
            ->groupBy('waste_items.id')
            ->get();
    $pdf = PDF::loadView('pdf', compact('wastes','wasteItems'));

    return $pdf->download('invoice_waste.pdf');
}


    }


