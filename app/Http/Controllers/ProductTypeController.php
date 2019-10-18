<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductTypeController extends Controller
{
    public  function index()
    {
        $types =DB::table('product_types')->paginate(15);
        return view('products.list',compact('types'));
    }
    public function create()
    {
        return view('productTypes.create');
    }


    public function store(Request $request)
    {
      //  dd($request->all());
        $request->validate([
            'name' => 'required|max:255',
        ]);

        ProductType::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Product Type created successfully.');
    }

    public function show(ProductType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductType $productType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductType $productType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductType $productType)
    {
        //
    }
}
