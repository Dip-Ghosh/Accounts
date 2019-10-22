@extends('layouts.admin.master')
@section('title','Customers list')
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
                                <th scope="col">Name</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach($customers as $customer)
                                <tr>

                                    <td>{{$i++}}</td>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->mobile}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td>
                                        <form action="{{ route('customer.destroy',$customer->id)}}"  method="POST">
                                            <a  href="{{route('customer.edit',$customer->id)}}" class="btn btn-sm btn-success">Edit</a>

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
@section('topleft')
    <h1>
        Customers  List
        <small>Control panel</small>
    </h1>
@endsection
@section('topright')
    Customers  List
@endsection
