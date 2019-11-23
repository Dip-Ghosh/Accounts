<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


<section class="content" style="margin-top:50px">


    <div class="row">

        <div class="col-md-8" style=":right; margin-top:3px;margin-left:61%">

            <a href="{{ route('debit.downloadPdf',$debit->id) }}" class="btn btn-danger">Create PDF</a>
        </div>
        <div class="col-md-3">

        </div>

        <div class="col-md-6 offset-3">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="information">
                        <table width="100%">
                            <tr>
                                <td align="center">
                                    <div>
                                        <img src="{{asset('images/g8.png')}}" alt="Logo" width="150" class="logo"/>
                                    </div>
                                    <div>
                                        <h5>G8ICT Limited</h5>
                                        <address>MonipuriPara,Dhaka</address>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
                <hr>
                <h3 align="center">Credit Vouchar</h3>
                <div class="box-body">

                    <div class="information">


                        <table width="100%">

                            <tr>
                                <td align="left" style="width: 40%;">
                                    <label>Date: </label><br>
                                    {{ $debit->vouchar_date }}
                                </td>

                                <td align="right" style="width: 40%;">

                                    <label>Payment Type: </label><br>
                                    @if($debit->pay_type === 1)
                                        Cash
                                    @else
                                        Check
                                    @endif

                                </td>
                            </tr>

                        </table>
                    </div>
                </div>

                <hr>
                <div class="box-body">
                    <div class="information">


                        <div class="box-body">
                            <label> Vouchar Details: </label>
                            <table class="table table-bordered table-striped table-responsive" border="1px"
                                   width="100%">

                                <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Account</th>
                                    <th>Amount</th>
                                    <th>Amount Type</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i=1;


                                @endphp

                                @foreach($vouchars as $vouchar)

                                    <tr scope="row">
                                        <td>{{$i++}}</td>
                                        <td>{{$vouchar->AccountName}}</td>
                                        <td>{{$vouchar->amount}}</td>
                                        <td>
                                            @if($vouchar->amount_type === 1) Credit
                                            @else Debit
                                            @endif
                                        </td>

                                    </tr>

                                @endforeach


                                </tbody>
                            </table>

                        </div>
                        <div class="box-body">
                            <div class="information">
                                <table width="100%">
                                    <tr>

                                        <td align="center" style="width: 40%;">
                                            <label>Total Price:
                                                @php
                                                    $vouchar='';
                                                  $sum=0;
                                                @endphp
                                                @foreach($vouchars as $vouchar)
                                                    @php

                                                        $sum+=$vouchar->amount;
                                                    @endphp
                                                @endforeach
                                                {{$sum}}/=
                                            </label><br>
                                        </td>


                                    </tr>

                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="box-body">
                            <div class="information">
                                <table width="100%">
                                    <tr>
                                        <td align="left" style="width: 40%;">
                                            <label>Note : </label><br>
                                            {{$debit->description}}
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>

                    </div>

                </div>
                <hr>


            </div>
        </div>


    </div>
</section>

</body>
</html>
