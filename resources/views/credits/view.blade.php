@extends('layouts.admin.master')
@section('title','Credit view')
@section('content')

    <section class="content" style="margin-top:50px">


        <div class="row">

            <div class="col-md-8" style=":right; margin-top:3px;margin-left:61%">

                                <a href="{{ route('credit.downloadPdf',$credit->id) }}" class="btn btn-danger">Create PDF</a>
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
                                        {{ $credit->vouchar_date }}
                                    </td>

                                    <td align="right" style="width: 40%;">

                                        <label>Payment Type: </label><br>
                                        @if($credit->pay_type === 1)
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

                                     $sum=0;
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
                                                    @endphp
                                                    @foreach($vouchars as $vouchar)
                                                        @php


                                                            $sum=$sum + $vouchar->amount;
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
                                                {{$credit->description}}
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

@endsection

@section('js')
@endsection
@section('topleft')
    <h1>
        Credit Vouchar
        <small>Control panel</small>
    </h1>
@endsection
@section('topright')
    Credit
@endsection
