@extends('layouts.admin.master')
@section('title','Waste  Edit')
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


                <form method="POST" action="{{route('waste.update',$wastes->id)}}">

                    @CSRF
                    @method('put')
                    <div class="form-group">
                        <label>InVoice Id </label>
                        <input type="text" name="invoice_no" class="form-control" id="invoice_no" aria-describedby=""
                               value="{{$wastes->invoice_no}}">
                    </div>


                    <div class="form-group">
                        <label>Note</label>
                        <textarea type="text" name="note" class="form-control" id="note" aria-describedby=""
                                  rows="3" cols="250" value="">{{$wastes->note}}
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>Date</label>
                        <input data-date-format="yyyy-mm-dd" name="date" class="form-control" id="date"
                               aria-describedby="" value="{{$wastes->date}}">
                    </div>


                    <div id="input_fields_wrap" class="row input_fields_wrap">
                        @foreach($items as $item)
                            <div class="input_fields">

                                <div class="col-md-4">
                                    <label>Choose Products</label>
                                    <select class="form-control" name="product_id[]">
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
                                                        class="btn btn-primary add_field_button "
                                                        style="margin-top: 25px">+
                                                </button>
                                            </div>
                                        </div>

                                    @else
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <button type="button" id="remove " name="remove"
                                                        class="btn btn-primary remove_field_button "
                                                        style="margin-top: 25px">-
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


    <script src="{{asset('https://code.jquery.com/jquery-3.4.1.min.js')}}"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('#date').datepicker('setDate', 'today');

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
    Waste  Edit
    <small>Control panel</small>
@endsection
@section('topright')
    Waste
@endsection
