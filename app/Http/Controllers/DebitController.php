<?php

namespace App\Http\Controllers;

use App\ControlLedger;
use App\Vouchar;
use App\VoucharDetails;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DebitController extends Controller
{
    public function index()
    {
        $debits = VoucharDetails::join('vouchars', 'vouchars.id', '=', 'vouchar_details.vouchar_id')
            ->join('control_ledgers', 'control_ledgers.id', '=', 'vouchar_details.account_code')
            ->select('vouchars.*', 'control_ledgers.name as AccountName', DB::raw('SUM(vouchar_details.amount) As Total_amount'))->where('vouchars.vouchar_type', '=', 2)
            ->groupBy('vouchars.id')
            ->paginate(5);

        return view('debits.list', compact('debits'));
    }

    public function create()
    {
        $controlledgers = ControlLedger::all();
        return view('debits.create', compact('controlledgers'));

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
            'vouchar_type' =>$request->vouchar_type=2,
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
        return redirect('debit')->with('success', 'Debit  created successfully.');
    }


    public function show($id)
    {

        $debit = Vouchar::find($id);
        $vouchars = VoucharDetails::where('vouchar_id',$id)
            ->join('control_ledgers', 'control_ledgers.id', '=', 'vouchar_details.account_code')
            ->select('control_ledgers.name as AccountName','vouchar_details.*')
            ->groupBy('vouchar_details.id')
            ->get();
        //dd($vouchars);
        return view('debits.view', compact('debit', 'vouchars'));

    }


    public function edit($id)
    {
        $debit = Vouchar::find($id);
        $vouchars = VoucharDetails::where('vouchar_id', '=', $id)->get();
        $controlledgers = ControlLedger::all();
        return view('debits.edit', compact('debit', 'vouchars', 'controlledgers'));


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
        $debit = Vouchar::find($id);
        $debit->pay_type = $request->pay_type;
        $debit->vouchar_date = $request->vouchar_date;
        $debit->description = $request->description;
        $debit->save();


        $count = count($request->input('account_code'));

        for ($i = 0; $i < $count; $i++) {
            VoucharDetails::create([
                'vouchar_id' => $debit->id,
                'account_code' => $request->account_code[$i],
                'amount' => $request->amount[$i],
                'amount_type' => $request->amount_type[$i],

            ]);
        }

        return redirect('debit')->with('success', 'Debit Updated successfully.');
    }


    public function destroy($id)
    {

        $vouchar = VoucharDetails::where('vouchar_id', $id);
        $vouchar->delete();

        $debit = Vouchar::find($id);
        $debit->delete();

        return redirect()->back()->with('success', 'Debit deleted successfully.');
    }

    public function download_Pdf($id)
    {

        $debit = Vouchar::find($id);
        $vouchars = VoucharDetails::where('vouchar_id',$id)
            ->join('control_ledgers', 'control_ledgers.id', '=', 'vouchar_details.account_code')
            ->select('control_ledgers.name as AccountName', DB::raw('SUM(vouchar_details.amount) As Total_amount'),'vouchar_details.*')
            ->groupBy('vouchar_details.id')
            ->get();

        $pdf = PDF::loadView('debits.pdf', compact('vouchars','debit'));

        return $pdf->download('debit.pdf');
    }
}
