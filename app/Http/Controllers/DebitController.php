<?php

namespace App\Http\Controllers;

use App\ControlLedger;
use App\Vouchar;
use App\VoucharDetails;
use Illuminate\Http\Request;

class DebitController extends Controller
{
    public function index()
    {
        $debits  = VoucharDetails::join('vouchars','vouchars.id','=','vouchar_details.vouchar_id')
            ->join('control_ledgers','control_ledgers.id','=','vouchar_details.account_code')
            ->select('vouchars.*','vouchar_details.*','control_ledgers.name as AccountName')->where('vouchars.vouchar_type','=',2)
            ->get();

        return view('debits.list',compact('debits'));
    }
    public function create()
    {
        $controlledgers = ControlLedger::all();
        return  view('debits.create',compact('controlledgers'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'vouchar_type' => 'required',
            'pay_type' => 'required',
            'account_code' => 'required',
            'vouchar_date' => 'required',
            'amount_type' => 'required',
            'amount' => 'required',

        ]);

        $vouchars = Vouchar::create([
            'vouchar_type' => $request->vouchar_type,
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
        return redirect('debit')->with('success', 'debit  created successfully.');
    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
