@extends('layouts.admin.master')
@section('title','Credit  list')
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
                                <th scope="col">Account Code</th>
                                <th scope="col">Pay Type</th>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Amount Type</th>
                                <th scope="col">Date</th>
                                <th scope="col" class="justify-content-center">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach($credits as $credit)
                                <tr>

                                    <td>{{$i++}}</td>
                                    @if($credit->vouchar_type === 1)
                                        <td>credit</td>
                                    @else
                                        <td>debit</td>
                                    @endif
                                    <td>{{$credit->AccountName}}</td>
                                    @if($credit->pay_type === 1)
                                        <td>Cash</td>
                                    @else
                                        <td>Check</td>
                                    @endif
                                    <td>{{$credit->description}}</td>
                                    <td>{{$credit->amount}}</td>

                                    @if($credit->amount_type === 1)
                                        <td>Credit</td>
                                    @else
                                        <td>Debit</td>
                                    @endif

                                    <td>{{$credit->vouchar_date}}</td>

                                    <td>
                                        <form action="{{ route('credit.destroy',$credit->id)}}" method="POST">
                                            <a href="{{route('credit.edit',$credit->id)}}"
                                               class="btn btn-sm btn-success">Edit</a>
                                            <a href="{{route('credit.show',$credit->id)}}"
                                               class="btn btn-sm btn-primary">View</a>
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
                                <th scope="col">Vouchar Type</th>
                                <th scope="col">Account Code</th>
                                <th scope="col">Pay Type</th>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Amount Type</th>
                                <th scope="col">Date</th>
                                <th scope="col" class="justify-content-center">Action</th>
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
        Credit List
        <small>Control panel</small>
    </h1>
@endsection
@section('topright')
    Credit  List
@endsection
