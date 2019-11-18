@extends('layouts.admin.master')
@section('title','Store In view')
@section('content')

    <section class="content" style="margin-top:50px">


        <div class="row">

            <div class="col-md-8" style=":right; margin-top:3px;margin-left:61%">

                <a href="{{ route('storein.downloadPdf',$storeIns->id) }}" class="btn btn-danger">Create PDF</a>
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
                    <h3 align="center">Store In Vouchar</h3>
                    <div class="box-body">

                        <div class="information">


                            <table width="100%">

                                <tr>
                                    <td align="left" style="width: 40%;">
                                        <label>Invoice No : </label><br>
                                        {{$storeIns->invoice_no}}
                                    </td>

                                    <td align="right" style="width: 40%;">

                                        <label>Date: </label><br>
                                        {{ $storeIns->date }}

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
                                        @foreach($suppliers as $c)

                                            <label>Supplier Name :{{$c->sname}}</label>

                                            <label>Mobile: {{ $c->mobile }}</label>

                                            <label>Adress: {{ $c->address }} </label>

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


                            <div class="box-body">
                                <label> Products: </label>
                                <table class="table table-bordered table-striped table-responsive" border="1px"
                                       width="100%">

                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Average Rate</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                        $sum=0;
                                    @endphp
                                    @foreach($Items as $Item)

                                        <tr scope="row">
                                            <td>{{$i++}}</td>
                                            <td>{{$Item->Pname}}</td>
                                            <td>{{$Item->quantity}}</td>
                                            <td>{{$Item->AvrPrice}}</td>
                                            <td>{{$Item->AvrPrice*$Item->quantity}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                            </div>
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

                                                            $sum+=$Item->AvrPrice*$Item->quantity;
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
                                        {{$storeIns->note}}
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

@section('js')
@endsection
@section('topleft')
    <h1>
        Store In Vouchar
        <small>Control panel</small>
    </h1>
@endsection
@section('topright')
    Store In
@endsection
