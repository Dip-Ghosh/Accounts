@extends('layouts.admin.master')
@section('title','Debit  list')
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
                                <th scope="col">Vouchar Type</th>
                                <th scope="col">Pay Type</th>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                                <th scope="col" >Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach($debits as $debit)
                                <tr>

                                    <td>{{$i++}}</td>
                                    @if($debit->vouchar_type === 1)
                                        <td>credit</td>
                                    @else
                                        <td>debit</td>
                                    @endif

                                    @if($debit->pay_type === 1)
                                        <td>Cash</td>
                                    @else
                                        <td>Check</td>
                                    @endif

                                    <td>{{$debit->description}}</td>
                                    <td>{{$debit->Total_amount}}</td>
                                    <td>{{$debit->vouchar_date}}</td>

                                    <td>
                                        <form action="{{ route('debit.destroy',$debit->id)}}" method="POST">
                                            <a href="{{route('debit.edit',$debit->id)}}"  class="btn btn-sm btn-success">Edit</a>

                                            @CSRF
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?')">Delete
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th scope="col">Serial No</th>
                                <th scope="col">Vouchar Type</th>
                                <th scope="col">Pay Type</th>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                                <th scope="col" >Action</th>
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
        Debit List
        <small>Control panel</small>
    </h1>
@endsection
@section('topright')
    Debit  List
@endsection
