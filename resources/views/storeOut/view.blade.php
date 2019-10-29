@extends('layouts.admin.master')
@section('title','Store Out view')
@section('content')

    <section class="content" style="margin-top:50px">


        <div class="row">

            <div  class="col-md-8" style=":right; margin-top:3px;margin-left:61%" >

                <a href="{{ route('storeout.downloadPdf',$storeOuts->id) }}" class="btn btn-danger" >Convert into PDF</a>
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
                    <h3 align="center">Store Out Vouchar</h3>
                    <div class="box-body">

                        <div class="information">


                            <table width="100%">

                                <tr>
                                    <td align="left" style="width: 40%;">
                                        <label>Invoice No : </label><br>
                                        {{$storeOuts->invoice_no}}
                                    </td>

                                    <td align="right" style="width: 40%;">

                                        <label>Date: </label><br>
                                        {{ $storeOuts->date }}

                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div><hr>
                    <div class="box-body">

                        <div class="information">


                            <table width="100%">

                                <tr>
                                    <td align="left" style="width: 40%;">
                                         @foreach($customers as $c)

                                         <label>Customer Name :{{$c->cname}}</label>

                                        <label>Mobile: {{ $c->mobile }}</label>

                                        <label>Email: {{ $c->email }} </label>

                                        @endforeach


                                    </td>

                                    <td align="right" style="width: 40%;">




                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>

                    <hr>
                    <div class="box-body">
                        <div class="information">

                            <label> Products: </label>
                            <table  border="1px" width="100%" >

                                <tr>
                                    <th>Serial</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Rate</th>
                                    <th>Total</th>
                                </tr>
                                @php
                                    $i=1;
                                    $sum=0;
                                @endphp
                                @foreach($Items as $Item)

                                    <tr align="center">
                                        <td>{{$i++}}</td>
                                        <td>{{$Item->Pname}}</td>
                                        <td>{{$Item->quantity}}</td>
                                        <td>{{$Item->price}}</td>
                                        <td>{{$Item->price*$Item->quantity}}</td>
                                    </tr>
                                @endforeach

                            </table>

                            <div class="box-body">
                                <div class="information">
                                    <table width="100%">
                                        <tr>

                                            <td align="right" style="width: 64%;">
                                                <label>Total Quantity :{{$Items->sum('quantity') }} </label><br>


                                            </td>
                                            <td align="right" style="width: 40%;">
                                                <label>Total Price:

                                                    @foreach($Items as $Item)
                                                        @php

                                                     $sum+=$Item->price*$Item->quantity;
                                                     @endphp
                                                    @endforeach
                                                    {{$sum}}/=
                                                </label><br>
                                            </td>


                                        </tr>

                                    </table>
                                </div>
                            </div>




                        </div>

                    </div>
                    <hr>
                    <div class="box-body">
                        <div class="information">
                            <table width="100%">
                                <tr>
                                    <td align="left" style="width: 40%;">
                                        <label>Note : </label><br>
                                        {{$storeOuts->note}}
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </section>

@endsection

@section('topleft')
    <h1>
        Store Out Vouchar
        <small>Control panel</small>
    </h1>
@endsection
@section('topright')
    Store Out
@endsection
