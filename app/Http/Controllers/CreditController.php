<?php

namespace App\Http\Controllers;

use App\ControlLedger;
use App\Vouchar;
use App\VoucharDetails;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NumberFormatter;
use number;

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
            'vouchar_type' => $request->vouchar_type = 1,
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


        $credit = Vouchar::find($id);
        $vouchars = VoucharDetails::where('vouchar_id', $id)
            ->join('control_ledgers', 'control_ledgers.id', '=', 'vouchar_details.account_code')
            ->select('control_ledgers.name as AccountName', 'vouchar_details.*')
            ->groupBy('vouchar_details.id')
            ->get();
        //dd($vouchars);
        return view('credits.view', compact('credit', 'vouchars'));

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

    public function download_Pdf($id)
    {

        $credit = Vouchar::find($id);
        $vouchars = VoucharDetails::where('vouchar_id', $id)
            ->join('control_ledgers', 'control_ledgers.id', '=', 'vouchar_details.account_code')
            ->select('control_ledgers.name as AccountName', DB::raw('SUM(vouchar_details.amount) As Total_amount'), 'vouchar_details.*')
            ->groupBy('vouchar_details.id')
            ->get();

        $pdf = PDF::loadView('credits.pdf', compact('vouchars', 'credit'));

        return $pdf->download('credit.pdf');
    }

    public function numCreate()
    {
        return view('credits.number');
    }

    public function num2english(Request $request)
    {

        $number = $request->number;
        $res = $this->convert_number_to_words($number);
        return response()->json($res);


    }


    public function convert_number_to_words($number)
    {

        $hyphen = '-';
        $conjunction = '  ';
        $negative = 'negative ';
        $dictionary = array(
            '1'=>'এক',
            '2'=>'দুই',
            '3'=>'তিন',
            '4'=>'চার',
            '5'=>'পাঁচ',
            '6'=>'ছয়',
            '7'=>'সাত',
            '8'=>'আট',
            '9'=>'নয়',
            '10'=>'দশ',
            '11'=>'এগার',
            '12'=>'বার',
            '13'=>'তের',
            '14'=>'চৌদ্দ',
            '15'=>'পনের',
            '16'=>'ষোল',
            '17'=>'সতের',
            '18'=>'আঠার',
            '19'=>'ঊনিশ',
            '20'=>'বিশ',
            '21'=>'একুশ',
            '22'=>'বাইশ',
            '23'=>'তেইশ',
            '24'=>'চব্বিশ',
            '25'=>'পঁচিশ',
            '26'=>'ছাব্বিশ',
            '27'=>'সাতাশ',
            '28'=>'আঠাশ',
            '29'=>'ঊনত্রিশ',
            '30'=>'ত্রিশ',
            '31'=>'একত্রিশ',
            '32'=>'বত্রিশ',
            '33'=>'তেত্রিশ',
            '34'=>'চৌত্রিশ',
            '35'=>'পঁয়ত্রিশ',
            '36'=>'ছত্রিশ',
            '37'=>'সাঁইত্রিশ',
            '38'=>'আটত্রিশ',
            '39'=>'ঊনচল্লিশ',
            '40'=>'চল্লিশ',
            '41'=>'একচল্লিশ',
            '42'=>'বিয়াল্লিশ',
            '43'=>'তেতাল্লিশ',
            '44'=>'চুয়াল্লিশ',
            '45'=>'পঁয়তাল্লিশ',
            '46'=>'ছেচল্লিশ',
            '47'=>'সাতচল্লিশ',
            '48'=>'আটচল্লিশ',
            '49'=>'ঊনপঞ্চাশ',
            '50'=>'পঞ্চাশ',
            '51'=>'একান্ন',
            '52'=>'বায়ান্ন',
            '53'=>'তিপ্পান্ন',
            '54'=>'চুয়ান্ন',
            '55'=>'পঞ্চান্ন',
            '56'=>'ছাপ্পান্ন',
            '57'=>'সাতান্ন',
            '58'=>'আটান্ন',
            '59'=>'ঊনষাট',
            '60'=>'ষাট',
            '61'=>'একষট্টি',
            '62'=>'বাষট্টি',
            '63'=>'তেষট্টি',
            '64'=>'চৌষট্টি',
            '65'=>'পঁয়ষট্টি',
            '66'=>'ছেষট্টি',
            '67'=>'সাতষট্টি',
            '68'=>'আটষট্টি',
            '69'=>'ঊনসত্তর',
            '70'=>'সত্তর',
            '71'=>'একাত্তর',
            '72'=>'বাহাত্তর',
            '73'=>'তিয়াত্তর',
            '74'=>'চুয়াত্তর',
            '75'=>'পঁচাত্তর',
            '76'=>'ছিয়াত্তর',
            '77'=>'সাতাত্তর',
            '78'=>'আটাত্তর',
            '79'=>'ঊনআশি',
            '80'=>'আশি',
            '81'=>'একাশি',
            '82'=>'বিরাশি',
            '83'=>'তিরাশি',
            '84'=>'চুরাশি',
            '85'=>'পঁচাশি',
            '86'=>'ছিয়াশি',
            '87'=>'সাতাশি',
            '88'=>'আটাশি',
            '89'=>'ঊননব্বই',
            '90'=>'নব্বই',
            '91'=>'একানব্বই',
            '92'=>'বিরানব্বই',
            '93'=>'তিরানব্বই',
            '94'=>'চুরানব্বই',
            '95'=>'পঁচানব্বই',
            '96'=>'ছিয়ানব্বই',
            '97'=>'সাতানব্বই',
            '98'=>'আটানব্বই',
            '99'=>'নিরানব্বই'
        );

        $digits = array('',
            100 => 'শত',
            1000 => 'হাজার',
            100000 => 'লক্ষ',
            10000000 => 'কোটি',
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int)$number < 0) || (string)$number < 0 - PHP_INT_MAX) {

            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }
        $number = ltrim($number, '0');

        if ($number < 0) {
            return $negative . $this->convert_number_to_words(abs($number));
        }

        $string = $fraction = null;
        $number = round($number, 2);

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        $fraction = ltrim($fraction, '0');
        switch (true) {
            case $number >= 10000000:
                $crore = $number / 10000000;
                $remainder = $number % 10000000;
                $string = $dictionary[$crore] . ' ' . $digits[10000000];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number_to_words($remainder);
                }

                break;

            case $number >= 100000 and $number < 10000000 :
                $lacs = $number / 100000;
                $remainder = $number % 100000;
                $string = $dictionary[$lacs] . ' ' . $digits[100000];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number_to_words($remainder);
                }
                break;
            case $number >= 1000 and $number < 100000:
                $thousand = $number / 1000;
                $remainder = $number % 1000;
                $string = $dictionary[$thousand] . ' ' . $digits[1000];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number_to_words($remainder);
                }
                break;
            case $number < 1000 and $number >= 100 :
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $digits[100];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number_to_words($remainder);
                }
                break;
            case $number < 100 and $number >= 21:
                $tens = ((int)($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            default:
                $string .=$dictionary[$number];
                $string .= " "."টাকা";
                break;


        }

        if (null !== $fraction && is_numeric($fraction) && $fraction!=0) {

            $string .= " এবং  ";
            if (strlen($fraction) == 1) {

                $fraction = str_pad($fraction, 2, '0', STR_PAD_RIGHT);
                $string .= $dictionary[($fraction)];

            }

            elseif  (strlen($fraction) == 2)
            {

                if($fraction >=1  && $fraction <=99)
                {
                    $string .= $dictionary[$fraction];

                }
               
            }


            $string .= " পয়সা ";
        }

        return $string;


    }


//    function convert_number_to_words($number)
//    {
//        $hyphen = '-';
//        $conjunction = '  ';
//        $negative = 'negative ';
//        $dictionary = array(
//            0 => 'Zero',
//            1 => 'One',
//            2 => 'Two',
//            3 => 'Three',
//            4 => 'Four',
//            5 => 'Five',
//            6 => 'Six',
//            7 => 'Seven',
//            8 => 'Eight',
//            9 => 'Nine',
//            10 => 'Ten',
//            11 => 'Eleven',
//            12 => 'Twelve',
//            13 => 'Thirteen',
//            14 => 'Fourteen',
//            15 => 'Fifteen',
//            16 => 'Sixteen',
//            17 => 'Seventeen',
//            18 => 'Eighteen',
//            19 => 'Nineteen',
//            20 => 'Twenty',
//            30 => 'Thirty',
//            40 => 'Fourty',
//            50 => 'Fifty',
//            60 => 'Sixty',
//            70 => 'Seventy',
//            80 => 'Eighty',
//            90 => 'Ninety',
////            100 => 'Hundred',
////            1000 => 'Thousand',
////            100000 => 'Lacs',
////            10000000 => 'Crore',
//
//        );
//
//        $digits = array('',
//            100 => 'Hundred',
//            1000 => 'Thousand',
//            100000 => 'Lacs',
//            10000000 => 'Crore',
//        );
//
//        if (!is_numeric($number)) {
//            return false;
//        }
//
//        if (($number >= 0 && (int)$number < 0) || (string)$number < 0 - PHP_INT_MAX) {
//
//            trigger_error(
//                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
//                E_USER_WARNING
//            );
//            return false;
//        }
//        $number = ltrim($number, '0');
//
//        if ($number < 0) {
//            return $negative . $this->convert_number_to_words(abs($number));
//        }
//
//        $string = $fraction = null;
//        $number = round($number, 2);
//
//        if (strpos($number, '.') !== false) {
//            list($number, $fraction) = explode('.', $number);
//        }
//
//        $fraction = ltrim($fraction, '0');
//        switch (true) {
//            case $number >= 10000000:
//                $crore = $number / 10000000;
//                $remainder = $number % 10000000;
//                $string = $dictionary[$crore] . ' ' . $digits[10000000];
//                if ($remainder) {
//                    $string .= $conjunction . $this->convert_number_to_words($remainder);
//                }
//
//                break;
//
//            case $number >= 100000 and $number < 10000000 :
//                $lacs = $number / 100000;
//                $remainder = $number % 100000;
//                $string = $dictionary[$lacs] . ' ' . $digits[100000];
//                if ($remainder) {
//                    $string .= $conjunction . $this->convert_number_to_words($remainder);
//                }
//                break;
//            case $number >= 1000 and $number < 100000:
//                $thousand = $number / 1000;
//                $remainder = $number % 1000;
//                $string = $dictionary[$thousand] . ' ' . $digits[1000];
//                if ($remainder) {
//                    $string .= $conjunction . $this->convert_number_to_words($remainder);
//                }
//                break;
//            case $number < 1000 and $number >= 100 :
//                $hundreds = $number / 100;
//                $remainder = $number % 100;
//                $string = $dictionary[$hundreds] . ' ' . $digits[100];
//                if ($remainder) {
//                    $string .= $conjunction . $this->convert_number_to_words($remainder);
//                }
//                break;
//            case $number < 100 and $number >= 21:
//                $tens = ((int)($number / 10)) * 10;
//                $units = $number % 10;
//                $string = $dictionary[$tens];
//                if ($units) {
//                    $string .= $hyphen . $dictionary[$units];
//                }
//                break;
//            default:
//                $string .=$dictionary[$number];
//                    $string .= " "."Taka";
//                break;
//
//
//        }
//
//        if (null !== $fraction && is_numeric($fraction) && $fraction!=0) {
//
//            $string .= "  and ";
//            if (strlen($fraction) == 1) {
//
//                $fraction = str_pad($fraction, 2, '0', STR_PAD_RIGHT);
//                $string .= $dictionary[($fraction)];
//            }
//
//
//            if (strlen($fraction) == 2)
//            {
//                if($fraction >=1  && $fraction <=20)
//                {
//                    $string .= $dictionary[$fraction];
//
//                }
//                else
//                {
//                    $tens = ((int)($fraction / 10)) * 10;
//                    $units = $fraction % 10;
//                    $string .= $dictionary[$tens];
//                    if ($units) {
//                        $string .= $hyphen . $dictionary[$units];
//                    }
//
//                }
//
//            }
//
//
//            $string = $string . " Paisa";
//        }
//
//        return $string;
//
//    }
}
