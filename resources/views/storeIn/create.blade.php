@extends('layouts.admin.master')
@section('title','Store  Create')
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


                <form method="POST" action="{{route('storeIn.store')}}"  >

                    @CSRF
                    @method('POST')

                    <div class="form-group">
                        <label>Product Type</label>
                        <select class="custom-select form-control" id="product_type_id" name="product_type_id">
                            <option value="-1">Choose Product Type</option>
                            @foreach($product_types as $product_type)
                                <option value="{{$product_type->id}}">{{$product_type->name}} </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Choose Products</label>
                        <select class="form-control" name="product_id" id="product_id">
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Supplier</label>
                        <select class="custom-select form-control" id="supplier_id" name="supplier_id">
                            <option value="-1">Choose Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{$supplier->id}}">{{$supplier->name}} </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Quantity </label>
                        <input type="number" name="quantity" class="form-control" id="quantity" aria-describedby=""
                               placeholder="Enter Quantity ">
                    </div>

                    <div class="form-group">
                        <label>Purchase Price </label>
                        <input type="number" name="purchase_price" class="form-control" id="purchase_price" aria-describedby=""
                               placeholder="Enter Purchase Price ">
                    </div>

                    <div class="form-group">
                        <label>Note</label>
                        <textarea type="text" name="note" class="form-control" id="note" aria-describedby=""
                                  rows="3" cols="250"  placeholder="Enter Note">
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>Date</label>
                        <input data-date-format="yyyy-mm-dd" name="date" class="form-control" id="date" aria-describedby="" placeholder="Enter Date">
                    </div>



                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {

            $('#product_type_id').on('change', function () {

                $('select[name="product_id"]').empty();
                var product_type_id = $(this).val();

                if (product_type_id) {

                    $.ajax({

                        type: 'GET',
                        url: '/findProduct/' + product_type_id,
                        data: {'id': product_type_id},
                        dataType: 'json',
                        success: function (data) {

                            $('select[name="product_id"]').append('<option> -- Choose   Product</option>');
                            $.each(data, function (key, value) {
                                console.log(key);
                                $('select[name="product_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="product_id"]').empty();
                }

            });
        });

    </script>
    <script>
        $(document).ready(function() {

         // $('#date').
            $('#date').datepicker('setDate', 'today');
        });
    </script>

@endsection

 @section('topleft')
 Store  create
 <small>Control panel</small>
 @endsection
 @section('topright')Store
@endsection
