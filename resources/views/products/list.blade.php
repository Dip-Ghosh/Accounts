@extends('layouts.admin.master')
@section('title','Product  list')
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
                                <th scope="col">Name
                                <th scope="col">Size </th>
                                <th scope="col">Color</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Product Type</th>
                                <th scope="col">Manufacturer</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach($products as $product)
                                <tr>

                                    <td>{{$i++}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->size}}</td>
                                    <td>{{$product->color}}</td>
                                    <td>{{$product->brand}}</td>
                                    <td>{{$product->Tname}}</td>
                                    <td>{{$product->manufacturer}}</td>
                                    <td><img src="{{asset('images/product_image/'.$product->image)}}" width="100px" height="100px"></td>

                                    <td>
                                        <form action="{{ route('product.destroy',$product->id)}}"  method="POST">
                                            <a  href="{{route('product.edit',$product->id)}}" class="btn btn-sm btn-success">Edit</a>

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
                                <th scope="col">Name
                                <th scope="col">Size </th>
                                <th scope="col">Color</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Product Type</th>
                                <th scope="col">Manufacturer</th>
                                <th scope="col">Image</th>
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
        Product  List
        <small>Control panel</small>
    </h1>
@endsection
@section('topright')
    Product  List
@endsection
