<?php

namespace App\Http\Controllers;

use App\Company;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{

    public function index()
    {
        $companies = Company::all();
        return view('companies.list',compact('companies'));
    }


    public function create()
    {
        return view('companies.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',

        ]);


        //file save in image folder
        $image = '';
        if ($files = $request->file('logo')) {
            $image = mt_rand() . " " . $files->getClientOriginalName();
            $files->move(public_path('\images\company_image'), $image);
        }

        Company::create([
            'name' => $request->name,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'logo' => $image
        ]);


        return redirect('company')->with('success', 'Company  created successfully.');
    }


    public function show(Company $company)
    {
        //
    }

    public function edit($id)
    {
        $company = Company::find($id);
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'logo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',

        ]);

        $image = '';


        if ($files = $request->file('logo')) {

            $com = DB::table('companies')->where('id', '=', $id)->first();
            $filename = public_path() . '/images/company_image/' . $com->logo;
            \File::delete($filename);
            $image = mt_rand() . " " . $files->getClientOriginalName();
            $files->move(public_path('\images\company_image'), $image);

        }
        $company = Company::find($id);
        $company->name = $request->name;
        $company->address = $request->address;
        $company->email = $request->email;
        $company->mobile = $request->mobile;
        $company->logo = $image;
        $company->save();
        return redirect('company')->with('success', 'Company updated successfully.');


    }
    public function destroy($id)
    {

        $image = DB::table('companies')->where('id', '=', $id)->first();

        $filename = public_path() . '/images/company_image/' . $image->logo;
        \File::delete($filename);

        Company::find($id)->delete();
        return redirect()->back()->with('success', 'Company  deleted successfully.');
    }
}
