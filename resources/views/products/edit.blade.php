@extends('layouts.admin.master')
@section('title','Product  Edit')
@section('content')

    <div class="content" style="padding: 10px 150px 10px 150px ">

        <div class="box box-success box-body">
            <div class="formtxt">

                <div class="box-header with-border">
                    <div>
                        @if($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible">{{ $message }}</div>
                        @endif
                    </div>
                    <div>
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>


                <form method="POST" action="{{route('product.update',$product->id)}}"  enctype="multipart/form-data">

                    @CSRF
                    @method('put')

                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="" value="{{$product->name}}">
                    </div>

                    <div class="form-group">
                        <label>Product size</label>
                        <input type="number" name="size" class="form-control" id="size" aria-describedby=""
                               value="{{$product->size}}">
                    </div>

                    <div class="form-group">
                        <label>Product Color</label>
                        <input type="text" name="color" class="form-control" id="color" aria-describedby=""
                               value="{{$product->color}}">
                    </div>

                    <div class="form-group">
                        <label>Product Brand</label>
                        <input type="text" name="brand" class="form-control" id="brand" aria-describedby=""
                               value="{{$product->brand}}">
                    </div>

                    <div class="form-group">
                        <label>Product Manufacturer</label>
                        <input type="text" name="manufacturer" class="form-control" id="manufacturer" aria-describedby=""
                               value="{{$product->manufacturer}}">
                    </div>

                    <div class="form-group">
                        <label>Product Type</label>
                        <select class="custom-select form-control" name="product_type">
                            <option value="">Choose Product Type</option>
                            @foreach($product_types as $product_type)
                                @if($product_type->id === $product->product_type)
                                    <option selected value="{!! $product_type['id']!!}">{!!$product_type['name']!!}</option>
                                @else
                                    <option value="{!! $product_type['id']!!}">{!!$product_type['name']!!}</option>
                                @endif
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image"> Image</label>
                        <input type="file" name="image" class="form-control" id="image"/>
                        <p class="help-block">Image must be jpeg,png,jpg,gif,svg and max file size 2M.</p>

                                <div >
                                    <img width="150px" id="image_path" alt="image"
                                         src="{{ asset('images/product_image/'.$product->image) }}">

                                </div>


                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>

@endsection

@section('topleft')
    Product  Edit
    <small>Control panel</small>
@endsection
@section('topright')
    Product
@endsection
