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


                            <form method="POST" action="{{route('report.supplier_wise')}}">

                                @CSRF
                                @method('POST')


                                <div class="row">

                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label>Supplier</label>
                                            <select class="custom-select form-control" id="supplier_id"
                                                    name="supplier_id">
                                                <option value="-1">Choose Supplier</option>
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{$supplier->id}}">{{$supplier->name}} </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-9">

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
                                    <td>{{ $report->Iquantity}}</td>


                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th scope="col">Serial</th>
                                <th scope="col"> Product Name</th>
                                <th scope="col">Store In</th>
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
        Supplier Wise Report
        <small>Control panel</small>
    </h1>
@endsection
@section('topright')
    Supplier Wise Report
@endsection
