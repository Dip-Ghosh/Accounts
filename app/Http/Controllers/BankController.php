<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Http\Requests\bankFormValidation;
use Illuminate\Http\Request;

class BankController extends Controller
{

    public function index()
    {
        $banks = Bank::Paginate(15);
        return view('banks.list',compact('banks'));
    }


    public function create()
    {
        return view('banks.create');
    }


    public function store(bankFormValidation $request)
    {
        $bank = Bank::create([

            'name'=>$request->name,
            'address'=>$request->address,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
        ]);

        return redirect('bank')->with('success', 'Bank  created successfully.');
    }


    public function edit($id)
    {
        $bank = Bank::FindOrFail($id);
        return view('banks.edit',compact('bank'));
    }


    public function update(bankFormValidation $request, $id)
    {
        $bank = Bank::FindOrFail($id);
        $bank->name=$request->name;
        $bank->mobile=$request->mobile;
        $bank->email=$request->email;
        $bank->address=$request->address;
        $bank->save();

        return redirect('bank')->with('success','Bank Edited Successfully');
    }


    public function destroy($id)
    {
        $bank = Bank::FindOrFail($id);
        $bank->delete();
        return redirect()->back()->with('success','Bank deleted Successfully');

    }
}
