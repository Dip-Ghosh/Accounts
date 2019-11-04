@extends('layouts.admin.master')
@section('title','Report List')
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


                            <form method="POST" action="{{route('report.search')}}">

                                @CSRF
                                @method('POST')


                                <div class="row">

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label>From</label>
                                            <input data-date-format="yyyy-mm-dd" name="from" class="form-control"
                                                   id="from"
                                                   aria-describedby="" placeholder="Enter Date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>To</label>
                                            <input data-date-format="yyyy-mm-dd" name="to" class="form-control" id="to"
                                                   aria-describedby="" placeholder="Enter Date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <button type="submit"
                                                    class="btn btn-primary" style="margin-top: 25px">Search
                                            </button>
                                        </div>
                                    </div>


                                </div>


                            </form>


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
                                <th scope="col">Serial</th>
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
        $(document).ready(function () {

            $('#from').datepicker();
            $('#to').datepicker();
        });
    </script>
@endsection

@section('topleft')
    <h1>
        Date wise Report List
        <small>Control panel</small>
    </h1>
@endsection
@section('topright')
    Date wise Report
@endsection
