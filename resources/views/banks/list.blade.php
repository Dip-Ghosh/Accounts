@extends('layouts.admin.master')
@section('title','Bank list')
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        @if($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible">{{ $message }}  <button type="button" class="close" data-dismiss="alert">×</button></div>
                        @endif
                    </div>
                    <div class="box-body">
                        <table id="pageList" class="table table-bordered table-striped table-responsive">
                            <thead>
                            <tr>
                                <th scope="col">Serial No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach($banks as $bank)
                                <tr>

                                    <td>{{$i++}}</td>
                                    <td>{{$bank->name}}</td>
                                    <td>{{$bank->mobile}}</td>
                                    <td>{{$bank->email}}</td>
                                    <td>{{$bank->address}}</td>
                                    <td>
                                        <form action="{{ route('bank.destroy',$bank->id)}}" method="POST">
                                            <a href="{{route('bank.edit',$bank->id)}}"
                                               class="btn btn-sm btn-success">Edit</a>

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
                                <th scope="col">Name</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Email</th>
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
        Bank List
        <small>Control panel</small>
    </h1>
@endsection
@section('topright')
    Bank  List
@endsection
