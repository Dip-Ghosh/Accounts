<?php

namespace App\Http\Controllers;

use App\IncomeYear;
use Illuminate\Http\Request;

class IncomeYearController extends Controller
{

    public function index()
    {
        $incomes = IncomeYear::paginate(25);
        return view('incomeYears.list',compact('incomes'));
    }


    public function create()
    {
        return view('incomeYears.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'incomeYear' => 'required',
        ]);
        $incomes = $request->incomeYear;

        $i = ($incomes) . '-' . ($incomes+1);

        IncomeYear::create([
            'incomeYear'=>$i
        ]);

        return redirect('income')->with('success', 'Income year created successfully.');
    }



    public function edit($id)
    {
        $income = IncomeYear::find($id);
        return view('incomeYears.edit',compact('income'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'incomeYear' => 'required',
        ]);

        $yearIncome = IncomeYear::find($id);
        $incomes = $request->incomeYear;
        $i = ($incomes) . '-' . ($incomes+1);
        $yearIncome->incomeYear = $i;
        $yearIncome->save();
        return redirect('income')->with('success', 'Income Year Edited successfully.');


        //return redirect('unit');


    }


    public function destroy($id)
    {
        $income = IncomeYear::find($id);

        $income->delete();

        return redirect()->back()->with('success', 'Income Year deleted successfully.');
    }
}
