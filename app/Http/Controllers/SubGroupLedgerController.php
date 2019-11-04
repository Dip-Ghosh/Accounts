<?php

namespace App\Http\Controllers;

use App\Groupledger;
use App\SubGroupLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubGroupLedgerController extends Controller
{

    public function index()
    {

        $sub_ledgers = SubGroupLedger::join('groupledgers', 'sub_group_ledgers.group_ledger_id', '=', 'groupledgers.id')
            ->select('sub_group_ledgers.*', 'groupledgers.name as gname')
            ->paginate(10);

        return view('subledger.list', compact('sub_ledgers'));
    }


    public function create()
    {
        $ledgers = Groupledger::all();
        return view('subledger.create', compact('ledgers'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'required',
            'group_ledger_id' => 'required',

        ]);


        SubGroupLedger::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'group_ledger_id' => $request->group_ledger_id,

        ]);


        return redirect('subledger')->with('success', 'Sub group Ledger  created successfully.');

    }


    public function edit($id)
    {
        $ledgers = Groupledger::all();
       $subledger= SubGroupLedger::find($id);


        return view('subledger.edit', compact('subledger','ledgers'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'required',
            'group_ledger_id' => 'required',

        ]);

        $ledger = SubGroupLedger::find($id);
        $ledger->code = $request->code;
        $ledger->name = $request->name;
        $ledger->description = $request->description;
        $ledger->group_ledger_id = $request->group_ledger_id;
        $ledger->save();
        return redirect('subledger')->with('success', ' Sub Ledgers  Updated successfully.');
    }


    public function destroy($id)
    {
        $ledger = SubGroupLedger::find($id);
        $ledger->delete();
        return redirect()->back()->with('success', 'Sub Group Ladger  Deleted successfully.');

    }

}
