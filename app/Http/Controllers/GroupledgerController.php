<?php

namespace App\Http\Controllers;

use App\Groupledger;
use Illuminate\Http\Request;

class GroupledgerController extends Controller
{

    public function index()
    {
        $ledgers = Groupledger::paginate(10);
        return view('ledgers.list', compact('ledgers'));
    }


    public function create()
    {
        return view('ledgers.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'required',

        ]);


        Groupledger::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,

        ]);


        return redirect('ledger')->with('success', 'Ledger  created successfully.');

    }




    public function edit($id)
    {
        $ledgers = Groupledger::find($id);

        return view('ledgers.edit', compact('ledgers'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'required',

        ]);

        $ledger = Groupledger::find($id);
        $ledger->code = $request->code;
        $ledger->name = $request->name;
        $ledger->description  = $request->description;
        $ledger->save();
        return redirect('ledger')->with('success', 'Ledgers  Updated successfully.');
    }


    public function destroy($id)
    {
        $ledger = Groupledger::find($id);
        $ledger->delete();
        return redirect()->back()->with('success', 'Group Ladger  Deleted successfully.');

    }
}
