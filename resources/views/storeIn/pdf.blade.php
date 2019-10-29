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
                    </div><hr>
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
</body>
</html>
