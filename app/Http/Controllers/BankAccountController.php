<?php

namespace App\Http\Controllers;

use App\Bank;
use App\BankAccount;
use App\BankBranch;
use App\Http\Requests\bankAccountFormValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankAccountController extends Controller
{

    public function index()
    {
        $bank_accounts = DB::table('bank_accounts')
            ->join('banks','banks.id','=','bank_accounts.bank_id')
            ->join('bank_branches','bank_branches.id','=',	'bank_accounts.branch_id')
            ->select('bank_accounts.*','banks.name as bankName','bank_branches.name as branchName')
            ->paginate(15);

        return view('bank_accounts.list',compact('bank_accounts'));
    }


    public function create()
    {
        $banks = Bank::all();
        $bank_branches =BankBranch::all();
        return view('bank_accounts.create',compact('banks','bank_branches'));
    }


    public function store(bankAccountFormValidation $request)
    {
        BankAccount::create([

            'name'=>$request->name,
            'address'=>$request->address,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'bank_id'=>$request->bank_id,
            'branch_id'=>$request->branch_id
        ]);

        return redirect('bankAccount')->with('success', 'Bank  Account created successfully.');
    }


    public function edit($id)
    {
        $bank_account = BankAccount::FindOrFail($id);
        $banks = Bank::all();
        $bank_branches =BankBranch::all();
        return view('bank_accounts.edit',compact('banks','bank_branches','bank_account'));
    }

    public function update(bankAccountFormValidation $request,$id)
    {
        $bank_account = BankAccount::FindOrFail($id);
        $bank_account->name = $request->name;
        $bank_account->address = $request->address;
        $bank_account->email = $request->email;
        $bank_account->mobile = $request->mobile;
        $bank_account->bank_id = $request->bank_id;
        $bank_account->branch_id = $request->branch_id;
        $bank_account->save();
        return redirect('bankAccount')->with('success', 'Bank  Account Updated successfully.');
    }


    public function destroy($id)
    {
        $bank_account = BankAccount::FindOrFail($id);
        $bank_account->delete();
        return redirect()->back()->with('success', 'Bank Account Deleted Successfully.');
    }
}
