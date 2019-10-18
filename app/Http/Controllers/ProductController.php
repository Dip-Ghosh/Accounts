<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function index()
    {
        $products = DB::table('products')
            ->join('product_types', 'product_types.id', '=', 'products.product_type')
            ->select('product_types.name as Tname', 'products.*')
            ->get();
        return view('products.list', compact('products'));
    }


    public function create()
    {
        $product_types = ProductType::all();
        return view('products.create', compact('product_types'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'product_type' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',

        ]);


        //file save in image folder
        $image = '';
        if ($files = $request->file('image')) {
            $image = mt_rand() . " " . $files->getClientOriginalName();
            $files->move(public_path('\images\product_image'), $image);
        }
        // dd($files);
        Product::create([
            'name' => $request->name,
            'size' => $request->size,
            'color' => $request->color,
            'brand' => $request->brand,
            'product_type' => $request->product_type,
            'manufacturer' => $request->manufacturer,
            'image' => $image
        ]);


        return redirect('product')->with('success', 'Product  created successfully.');
    }


    public function edit($id)
    {
        $product = Product::find($id);
        $product_types = ProductType::all();
        return view('products.edit', compact('product', 'product_types'));
    }


    public function update(Request $request, $id)
    {

        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'product_type' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',

        ]);
        //file save in image folder

        $image = '';


        if ($files = $request->file('image')) {

            $pro = DB::table('products')->where('id', '=', $id)->first();
            $filename = public_path() . '/images/product_image/' . $pro->image;
            \File::delete($filename);

            $image = mt_rand() . " " . $files->getClientOriginalName();
            $files->move(public_path('\images\product_image'), $image);
        }

        $product = Product::find($id);
        $product->name = $request->name;
        $product->size = $request->size;
        $product->color = $request->color;
        $product->brand = $request->brand;
        $product->product_type = $request->product_type;
        $product->manufacturer = $request->manufacture;
        $product->image = $image;
        $product->save();
        return redirect('product')->with('success', 'Product  created successfully.');


    }


    public function destroy($id)
    {

        $image = DB::table('products')->where('id', '=', $id)->first();

        $filename = public_path() . '/images/product_image/' . $image->image;
        \File::delete($filename);

        Product::find($id)->delete();
        return redirect()->back()->with('success', 'Product  deleted successfully.');
    }
}
