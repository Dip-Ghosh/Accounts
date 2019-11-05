@extends('layouts.admin.master')
@section('title','Bank Branch list')
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
                                <th scope="col">Bank Name</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach($bank_branches as $bank_branch)
                                <tr>

                                    <td>{{$i++}}</td>
                                    <td>{{$bank_branch->name}}</td>
                                    <td>{{$bank_branch->mobile}}</td>
                                    <td>{{$bank_branch->email}}</td>
                                    <td>{{$bank_branch->address}}</td>
                                    <td>{{$bank_branch->bname}}</td>
                                    <td>
                                        <form action="{{ route('bankBranch.destroy',$bank_branch->id)}}" method="POST">
                                            <a href="{{route('bankBranch.edit',$bank_branch->id)}}"
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
                                <th scope="col">Address</th>
                                <th scope="col">Bank Name</th>
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
        Bank Branch List
        <small>Control panel</small>
    </h1>
@endsection
@section('topright')
    Bank Branch  List
@endsection
