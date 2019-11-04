<?php

namespace App\Http\Controllers;

use App\ControlLedger;
use App\Groupledger;
use App\SubGroupLedger;
use Illuminate\Http\Request;

class ControlLedgerController extends Controller
{

    public function index()
    {
       $controlLedgers = ControlLedger::join('groupledgers', 'control_ledgers.group_ledger_id', '=', 'groupledgers.id')
            ->join('sub_group_ledgers','sub_group_ledgers.id','=','control_ledgers.sub_group_ledger_id')
            ->select('sub_group_ledgers.name as sname', 'groupledgers.name as gname','control_ledgers.*')
            ->paginate(10);
       //dd($controlLedgers);
        return view('controlLedgers.list', compact('controlLedgers'));

    }


    public function create()
    {
        $ledgers = Groupledger::all();
        $sub_group_ledgers = SubGroupLedger::all();
        return view('controlLedgers.create',compact('ledgers','sub_group_ledgers'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'required',
            'group_ledger_id' => 'required',
            'sub_group_ledger_id' => 'required',

        ]);


        ControlLedger::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'group_ledger_id' => $request->group_ledger_id,
            'sub_group_ledger_id' => $request->sub_group_ledger_id,

        ]);


        return redirect('controlLedger')->with('success', 'control Ledger  created successfully.');
    }


    public function show(ControlLedger $controlLedger)
    {

    }


    public function edit($id)
    {
        $ledgers = Groupledger::all();
        $sub_group_ledgers = SubGroupLedger::all();
        $controlLedger = ControlLedger::find($id);

        return view('controlLedgers.edit',compact('ledgers','sub_group_ledgers','controlLedger'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'required',
            'group_ledger_id' => 'required',
            'sub_group_ledger_id' => 'required',

        ]);
        $ControlLedgers = ControlLedger::find($id);
        $ControlLedgers->code = $request->code;
        $ControlLedgers->name = $request->name;
        $ControlLedgers->description = $request->description;
        $ControlLedgers->group_ledger_id = $request->group_ledger_id;
        $ControlLedgers->sub_group_ledger_id = $request->sub_group_ledger_id;
        $ControlLedgers->save();
        return redirect('controlLedger')->with('success', 'Control Ledger  Updated successfully.');
    }


    public function destroy($id)
    {
        $controlLedger = ControlLedger::find($id);
        $controlLedger->delete();
        return redirect()->back()->with('success', 'Control Ladger  Deleted successfully.');
    }
}
