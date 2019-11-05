<?php

namespace App\Http\Controllers;

use App\BankBranch;
use App\Bank;
use App\Http\Requests\bankBranchFormValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankBranchController extends Controller
{

    public function index()
    {
        $bank_branches = BankBranch::all();
        return view('bank_branches.list', compact('bank_branches'));
    }


    public function create()
    {
        return view('bank_branches.create');
    }


    public function store(bankBranchFormValidation $request)
    {
        BankBranch::create([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'mobile' => $request->mobile,

        ]);
        return redirect('bankBranch')->with('success', 'Bank  branch created successfully.');
    }

    public function edit($id)
    {


        $bank_branch = BankBranch::FindOrFail($id);
        return view('bank_branches.edit', compact('bank_branch'));
    }


    public function update(bankBranchFormValidation $request, $id)
    {
        $bank_branch = BankBranch::FindOrFail($id);
        $bank_branch->name = $request->name;
        $bank_branch->address = $request->address;
        $bank_branch->email = $request->email;
        $bank_branch->mobile = $request->mobile;
        $bank_branch->save();
        return redirect('bankBranch')->with('success', 'Bank  branch Updated successfully.');

    }


    public function destroy($id)
    {
        $bank_branch = BankBranch::FindOrFail($id);
        $bank_branch->delete();
        return redirect()->back()->with('success', 'Bank Branch Deleted Successfully.');
    }
}
