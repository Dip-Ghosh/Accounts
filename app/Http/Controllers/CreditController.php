<?php

namespace App\Http\Controllers;

use App\ControlLedger;
use App\Vouchar;
use App\VoucharDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreditController extends Controller
{
    public function index()
    {
        $credits = VoucharDetails::join('vouchars', 'vouchars.id', '=', 'vouchar_details.vouchar_id')
            ->join('control_ledgers', 'control_ledgers.id', '=', 'vouchar_details.account_code')
            ->select('vouchars.*', 'control_ledgers.name as AccountName', DB::raw('SUM(vouchar_details.amount) As Total_amount'))->where('vouchars.vouchar_type', '=', 1)
            ->groupBy('vouchars.id')
            ->paginate(5);

        return view('credits.list', compact('credits'));
    }

    public function create()
    {
        $controlledgers = ControlLedger::all();
        return view('credits.create', compact('controlledgers'));
    }


    public function store(Request $request)
    {

        $request->validate([

            'pay_type' => 'required',
            'account_code' => 'required',
            'vouchar_date' => 'required',
            'amount_type' => 'required',
            'amount' => 'required',

        ]);

        $vouchars = Vouchar::create([
            'vouchar_type' =>$request->vouchar_type=1,
            'pay_type' => $request->pay_type,
            'vouchar_date' => $request->vouchar_date,
            'description' => $request->description,
        ]);

        $count = count($request->input('account_code'));

        for ($i = 0; $i < $count; $i++) {
            VoucharDetails::create([
                'vouchar_id' => $vouchars->id,
                'account_code' => $request->account_code[$i],
                'amount' => $request->amount[$i],
                'amount_type' => $request->amount_type[$i],

            ]);
        }
        return redirect('credit')->with('success', 'credit  created successfully.');
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $credit = Vouchar::find($id);
        $vouchars = VoucharDetails::where('vouchar_id', '=', $id)->get();
        $controlledgers = ControlLedger::all();
        return view('credits.edit', compact('credit', 'vouchars', 'controlledgers'));


    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'pay_type' => 'required',
            'account_code' => 'required',
            'vouchar_date' => 'required',
            'amount_type' => 'required',
            'amount' => 'required',

        ]);

        $items = VoucharDetails::where('vouchar_id', '=', $id);
        $items->delete();
        $credit = Vouchar::find($id);
        $credit->pay_type = $request->pay_type;
        $credit->vouchar_date = $request->vouchar_date;
        $credit->description = $request->description;
        $credit->save();


        $count = count($request->input('account_code'));

        for ($i = 0; $i < $count; $i++) {
            VoucharDetails::create([
                'vouchar_id' => $credit->id,
                'account_code' => $request->account_code[$i],
                'amount' => $request->amount[$i],
                'amount_type' => $request->amount_type[$i],

            ]);
        }

        return redirect('credit')->with('success', 'credit Updated successfully.');
    }


    public function destroy($id)
    {

        $vouchar = VoucharDetails::where('vouchar_id', $id);
        $vouchar->delete();

        $credit = Vouchar::find($id);
        $credit->delete();

        return redirect()->back()->with('success', 'Credit deleted successfully.');
    }
}
