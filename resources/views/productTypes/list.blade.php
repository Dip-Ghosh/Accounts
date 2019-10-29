@extends('layouts.admin.master')
@section('title','Product Type list')
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
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach($types as $type)
                                <tr>

                                    <td>{{$i++}}</td>
                                    <td>{{$type->name}}</td>
                                    <td>
                                        <form action="{{ route('productType.destroy',$type->id)}}"  method="POST">
                                            <a  href="{{route('productType.edit',$type->id)}}" class="btn btn-sm btn-success">Edit</a>

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
        Product Type List
        <small>Control panel</small>
    </h1>
@endsection
@section('topright')
    Product Type List
@endsection
