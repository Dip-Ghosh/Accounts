@extends('layouts.admin.master')
@section('title','Store Status List')
@section('content')



    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        @if($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible">{{ $message }}</div>
                        @endif
                    </div>
                    <div class="box-body">
                        <table id="pageList" class="table table-bordered table-striped table-responsive">

                            <thead>
                            <tr>
                                <th scope="col">Serial</th>
                                <th scope="col"> Product Name</th>
                                <th scope="col">Store In</th>
                                <th scope="col">Store Out</th>
                                <th scope="col">Waste</th>
                                <th scope="col">Remaining</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach($reports as $report)
                                <tr>

                                    <td>{{$i++}}</td>
                                    <td>{{$report->Pname}}</td>
                                    <td>{{ $report->Total_quantity}}</td>
                                    <td>{{ $report->StoreoutQuantity}}</td>
                                    <td>{{$report->wasteQuantity}}</td>
                                    <td>{{ $report->Total_quantity-$report->wasteQuantity-$report->StoreoutQuantity}}</td>

                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th scope="col">Serial </th>
                                <th scope="col"> Product Name</th>
                                <th scope="col">Store In</th>
                                <th scope="col">Store Out</th>
                                <th scope="col">Waste</th>
                                <th scope="col">Remaining</th>
                            </tr>
                            </tfoot>
                        </table>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection


@section('js')
    <script>
        $(function () {

            $('#pageList').DataTable();
        });

    </script>
    <script>
        $(document).ready(function () {

            $('#from').datepicker();
            $('#to').datepicker();
        });
    </script>
@endsection



@section('topleft')
    <h1>
        Store Status Report List
        <small>Control panel</small>
    </h1>
@endsection
@section('topright')
    Store Status Report
@endsection
