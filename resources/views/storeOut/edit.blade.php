@extends('layouts.admin.master')
@section('title','StoreOut  Edit')
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


                <form method="POST" action="{{route('storeOut.update',$storeOuts->id)}}">

                    @CSRF
                    @method('put')

                    <div class="form-group">
                        <label>Product Type</label>
                        <select class="custom-select form-control" name="product_type_id">
                            <option value="">Choose Product Type</option>
                            @foreach($product_types as $product_type)
                                @if($product_type->id === $storeOuts->product_type_id)
                                    <option selected
                                            value="{!! $product_type['id']!!}">{!!$product_type['name']!!}</option>
                                @else
                                    <option value="{!! $product_type['id']!!}">{!!$product_type['name']!!}</option>
                                @endif
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product </label>
                        <select class="custom-select form-control" name="product_id">
                            <option value="">Choose Product</option>
                            @foreach($products as $product)
                                @if($product->id === $storeOuts->product_id)
                                    <option selected value="{!! $product['id']!!}">{!!$product['name']!!}</option>
                                @else
                                    <option value="{!! $product['id']!!}">{!!$product['name']!!}</option>
                                @endif
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Qauntity</label>
                        <input type="number" name="quantity" class="form-control" id="quantity" aria-describedby=""
                               value="{{$storeOuts->quantity}}">
                    </div>

                    <div class="form-group">
                        <label>Note</label>
                        <textarea type="text" name="note" class="form-control" id="note" aria-describedby=""
                                  rows="3" cols="250"  >{{$storeOuts->note}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input name="date" class="form-control" id="date"   readonly
                                value="{{$storeOuts->date}}" >
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('topleft')
    Store Out   Edit
    <small>Control panel</small>
@endsection
@section('topright')
    Store Out
@endsection
