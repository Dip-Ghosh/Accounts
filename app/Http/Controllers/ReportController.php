<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Items;
use App\ItemOut;
use App\WasteItems;
use App\Product;

class ReportController extends Controller
{

    public function index()
    {


        $storein = Items::join('store_ins', 'items.storing_in', '=', 'store_ins.id')
            ->select('items.product_id', DB::raw('sum(IFNULL(items.quantity,0)) as Total_quantity'))
            ->groupby('items.product_id');

        $storeout = ItemOut::join('store_outs', 'item_outs.storing_out', '=', 'store_outs.id')
            ->select('item_outs.product_id', DB::raw('sum(IFNULL(item_outs.quantity,0)) as StoreoutQuantity'))
            ->groupby('item_outs.product_id');


        $waste = WasteItems::join('wastes', 'waste_items.waste_id', '=', 'wastes.id')
            ->select('waste_items.product_id', DB::raw('sum( IFNULL(waste_items.quantity,0)) as wasteQuantity'))
            ->groupby('waste_items.product_id');


        $reports = Product::leftJoin(DB::raw("({$storein->toSql()}) as storein"), 'products.id', '=', 'storein.product_id')
            ->mergeBindings($storein->getQuery())
            ->leftJoin(DB::raw("({$storeout->toSql()}) as storeout"), 'products.id', '=', 'storeout.product_id', 'left')
            ->leftJoin(DB::raw("({$waste->toSql()}) as storewaste"), 'products.id', '=', 'storewaste.product_id', 'left')
            ->mergeBindings($storeout->getQuery())
            ->mergeBindings($waste->getQuery())
            ->select('products.name as Pname', DB::raw('IFNULL(storein.Total_quantity,0) as Total_quantity'), DB::raw('IFNULL(storeout.StoreoutQuantity,0) as StoreoutQuantity'), DB::raw('IFNULL(storewaste.wasteQuantity,0) as wasteQuantity'))
            ->groupBy('products.name')
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('reports.storeReport', compact('reports'));

    }


    public function search_date_wise(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $storein = Items::join('store_ins', 'items.storing_in', '=', 'store_ins.id')
            ->whereBetween('store_ins.date', [$from, $to])
            ->select('items.product_id', DB::raw('sum(IFNULL(items.quantity,0)) as Total_quantity'))
            ->groupby('items.product_id');

        $storeout = ItemOut::join('store_outs', 'item_outs.storing_out', '=', 'store_outs.id')
            ->whereBetween('store_outs.date', [$from, $to])
            ->select('item_outs.product_id', DB::raw('sum(IFNULL(item_outs.quantity,0)) as StoreoutQuantity'))
            ->groupby('item_outs.product_id');


        $waste = WasteItems::join('wastes', 'waste_items.waste_id', '=', 'wastes.id')
            ->whereBetween('wastes.date', [$from, $to])
            ->select('waste_items.product_id', DB::raw('sum(IFNULL(waste_items.quantity,0)) as wasteQuantity'))
            ->groupby('waste_items.product_id');


        $reports = Product::join(DB::raw("({$storein->toSql()}) as storein"), 'products.id', '=', 'storein.product_id', 'left')
            ->mergeBindings($storein->getQuery())
            ->join(DB::raw("({$storeout->toSql()}) as storeout"), 'products.id', '=', 'storeout.product_id', 'left')
            ->join(DB::raw("({$waste->toSql()}) as storewaste"), 'products.id', '=', 'storewaste.product_id', 'left')
            ->mergeBindings($storeout->getQuery())
            ->mergeBindings($waste->getQuery())
            ->select('products.name as Pname', DB::raw('IFNULL(storein.Total_quantity,0) as Total_quantity'), DB::raw('IFNULL(storeout.StoreoutQuantity,0) as StoreoutQuantity'), DB::raw('IFNULL(storewaste.wasteQuantity,0) as wasteQuantity'))
            ->groupBy('products.name')
            ->orderBy('id', 'desc')
            ->orHavingRaw('Total_quantity>?', [0])
            ->orHavingRaw('StoreoutQuantity>?', [0])
            ->orHavingRaw('wasteQuantity>?', [0])
            ->get();

        return view('reports.dateReport', compact('reports'));

    }


    public function supplier_wise()
    {
        $suppliers = Supplier::all();
        $reports = DB::table('products')
            ->join('items', 'products.id', '=', 'items.product_id')
            ->join('store_ins', 'store_ins.id', '=', 'items.storing_in')
            ->select('items.quantity as Iquantity', 'products.name as Pname')
            ->groupBy('products.id')
            ->get();


        return view('reports.supplierReport', compact('reports', 'suppliers'));
    }


    public function supplier_wise_report(Request $request)
    {
        $suppliers = $request->supplier_id;
        $reports = DB::table('products')
            ->where('store_ins.supplier_id', '=', $suppliers)
            ->join('items', 'products.id', '=', 'items.product_id')
            ->join('store_ins', 'store_ins.id', '=', 'items.storing_in')
            ->select('items.quantity as Iquantity', 'products.name as Pname')
            ->groupBy('products.id')
            ->get();

        $suppliers = Supplier::all();
        return view('reports.supplierReport', compact('reports', 'suppliers'));

    }


}
