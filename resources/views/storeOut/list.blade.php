@extends('layouts.admin.master')
@section('title','Store Out  list')
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
                                <th scope="col">Serial No</th>
                                <th scope="col">Invoice No</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Total Quantity </th>
                                <th scope="col">Note</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach($storeOuts as $storeOut)
                                <tr>

                                    <td>{{$i++}}</td>
                                    <td>{{$storeOut->invoice_no}}</td>
                                    <td>{{$storeOut->name}}</td>
                                    <td>{{$storeOut->Total_quantity}}</td>
                                    <td>{{$storeOut->note}}</td>
                                    <td>{{$storeOut->date}}</td>


                                    <td>
                                        <form action="{{ route('storeOut.destroy',$storeOut->id)}}"  method="POST">
                                            <a  href="{{route('storeOut.edit',$storeOut->id)}}" class="btn btn-sm btn-success">Edit</a>
                                            <a  href="{{route('storeOut.show',$storeOut->id)}}" class="btn btn-sm btn-primary">View</a>
                                            @CSRF
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure to delete?')">Delete
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th scope="col">Serial No</th>
                                <th scope="col">Invoice No</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Total Quantity </th>
                                <th scope="col">Note</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
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
@endsection
@section('topleft')
    <h1>
        Store Out  List
        <small>Control panel</small>
    </h1>
@endsection
@section('topright')
    Store Out  List
@endsection
