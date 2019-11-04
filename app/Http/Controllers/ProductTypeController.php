<?php
namespace App\Http\Controllers;


use App\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductTypeController extends Controller
{
    public  function index()
    {
        $types =DB::table('product_types')->paginate(10);
        return view('productTypes.list',compact('types'));
    }

    public function create()
    {
        return view('productTypes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        ProductType::create([
            'name' => $request->name
        ]);

        return redirect('productType')->with('success', 'Product Type created successfully.');
    }



    public function edit($id)
    {
        $types = ProductType::find($id);
        return view('productTypes.edit',compact('types'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',

        ]);

        $types = ProductType::find($id);
        $types->name = $request->get('name');
        $types->save();
        return redirect('productType')->with('success', 'Product Type Edited successfully.');


        //return redirect('unit');


    }

    public function destroy($id)
    {
        $types = ProductType::find($id);

        $types->delete();

        return redirect()->back()->with('success', 'Product Type deleted successfully.');
    }
}
