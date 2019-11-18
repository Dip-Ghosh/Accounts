@extends('layouts.admin.master')
@section('title','StoreIn  Edit')
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


                <form method="POST" action="{{route('storeIn.update',$storeIns->id)}}">

                    @CSRF
                    @method('put')
                    <div class="form-group">
                        <label>InVoice Id </label>
                        <input type="text" name="invoice_no" class="form-control" id="invoice_no" aria-describedby=""
                             readonly  value="{{$storeIns->invoice_no}}">
                    </div>

                    <div class="form-group">
                        <label>Supplier</label>
                        <select class="custom-select form-control" id="supplier_id" name="supplier_id">
                            <option value="-1">Choose Supplier</option>
                            @foreach($suppliers as $supplier)
                                @if($supplier->id === $storeIns->supplier_id)
                                    <option selected value="{!! $supplier['id']!!}">{!!$supplier['name']!!}</option>
                                @else
                                    <option value="{!! $supplier['id']!!}">{!!$supplier['name']!!}</option>
                                @endif
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Note</label>
                        <textarea type="text" name="note" class="form-control" id="note" aria-describedby=""
                                  rows="3" cols="250" value="">{{$storeIns->note}}
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>Date</label>
                        <input data-date-format="yyyy-mm-dd" name="date" class="form-control" id="date"
                               aria-describedby="" value="{{$storeIns->date}}">
                    </div>



                        <div  id="input_fields_wrap" class="row input_fields_wrap">
                            @foreach($items as $item)
                                <div class="input_fields">

                                    <div class="col-md-4">
                                        <label>Choose Products</label>
                                        <select class="form-control" name="product_id[]" >
                                            <option value="-1">Choose Product</option>
                                            @foreach($products as $product)
                                                @if($product->id === $item->product_id)
                                                    <option selected
                                                            value="{!! $product['id']!!}">{!!$product['name']!!}</option>
                                                @else
                                                    <option value="{!! $product['id']!!}">{!!$product['name']!!}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Quantity </label>
                                                <input type="number" name="quantity[]" class="form-control"
                                                       aria-describedby=""
                                                       value="{{$item->quantity}}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Price </label>
                                                <input type="number" name="price[]" class="form-control"
                                                       aria-describedby="" value="{{$item->price}}">
                                            </div>
                                        </div>


                                        @if ($loop->first)
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <button type="button" id="add-more " name="add-more"
                                                            class="btn btn-primary add_field_button " style="margin-top: 25px">+
                                                    </button>
                                                </div>
                                            </div>

                                        @else
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <button type="button" id="remove " name="remove" class="btn btn-danger remove_field_button " style="margin-top: 25px">-
                                                    </button>
                                                </div>
                                            </div>


                                        @endif


                                    </div>
                                </div>


                            @endforeach
                        </div>




                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>




@endsection

@section('js')
    <script>
        $(document).ready(function () {

            $('#date').datepicker();
        });
    </script>

    <script>
        $(".add_field_button").click(function (e) {
            e.preventDefault();

            $(".input_fields_wrap").append(' <div class=" input_fields" >' + '<div class="col-md-4 ">\n' +
                '                            <label>Choose Products</label>\n' +
                '                            <select class="form-control" name="product_id[]" id="product_id">\n' +
                ' <option value="-1">Choose Product</option>' +
                ' @foreach($products as $product)' +
                ' <option value="{{$product->id}}">{{$product->name}} </option>' +
                '  @endforeach' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-md-8">\n' +
                '                            <div class="col-md-4">\n' +
                '                                <div class="form-group">\n' +
                '                                    <label>Quantity </label>\n' +
                '                                    <input type="number" name="quantity[]" class="form-control" id="quantity[]" aria-describedby=""\n' +
                '                                           placeholder=" Quantity ">\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '\n' +
                '                            <div class="col-md-4">\n' +
                '                                <div class="form-group">\n' +
                '                                    <label>Price </label>\n' +
                '                                    <input type="number" name="price[]" class="form-control" id="price[]" aria-describedby=""\n' +
                '                                           placeholder=" Price ">\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '\n' +
                '\n' +
                '                            <button type="button" id="remove" name="remove" class="btn btn-primary remove_field_button " style="margin-top: 25px">-</button>\n' +
                '                        </div>\n' +
                '\n' +
                '\n' +
                '                    </div>');

        });


        $("body").on("click", ".remove_field_button", function (e) {
            $(this).parents('.input_fields ').remove();
        });


    </script>

@endsection
@section('topleft')
    Store In  Edit
    <small>Control panel</small>
@endsection
@section('topright')
    Store In
@endsection
