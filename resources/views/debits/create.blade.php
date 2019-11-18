@extends('layouts.admin.master')
@section('title','Debit  Create')
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


                <form method="POST" action="{{route('debit.store')}}">
                    @CSRF
                    @method('POST')
                    <div class="form-group">
                        <label>Vouchar Type</label>
                        <select class="custom-select form-control" id="vouchar_type" name="vouchar_type">
                            <option value="-1">Choose Vouchar Type</option>
                            <option value="1" >credit</option>
                            <option value="2" selected>debit</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Payment Type</label>
                        <select class="custom-select form-control" id="pay_type" name="pay_type">
                            <option value="-1">Choose Payment Type</option>
                            <option value="1">Cash</option>
                            <option value="2">Check</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Date</label>
                        <input data-date-format="yyyy-mm-dd" name="vouchar_date" class="form-control" id="vouchar_date"
                               aria-describedby="" placeholder="Enter Date">
                    </div>


                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" name="description" class="form-control" id="dest" rows="3" cols="80"
                                  placeholder="Describe something here..."></textarea>
                    </div>

                    <div class="row input_fields_wrap">

                        <div class="col-md-4">
                            <label>Account Code</label>
                            <select class="custom-select form-control" id="account_code" name="account_code[]">
                                <option value="-1">Choose Account Type</option>

                                @foreach($controlledgers as $controlledger)
                                    <option value="{{$controlledger->id}}">{{$controlledger->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-8">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="" name="amount[]" class="form-control" id="amount"
                                           aria-describedby="" placeholder="Enter Amount">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Amount Type</label>
                                    <select class="custom-select form-control" id="amount_type" name="amount_type[]">
                                        <option value="-1">Choose Amount Type</option>
                                        <option value="1">credit</option>
                                        <option value="2">debit</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="button" id="add-more " name="add-more"
                                            class="btn btn-primary add_field_button " style="margin-top: 25px">+
                                    </button>
                                </div>
                            </div>


                        </div>


                    </div>

                    <div class="form-group">
                        <button type="submit"
                                class="btn btn-primary" style="margin-top: 25px">Submit
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#vouchar_date').datepicker('setDate', 'today');
        });
    </script>
    <script>

        $(".add_field_button").click(function (e) {
            e.preventDefault();

            $(".input_fields_wrap").append(' <div class=" input_fields">'+' <div class="col-md-4">' +
                '<label>Account Code</label>' +
                '<select class="custom-select form-control" id="account_code[]" name="account_code[]">' +
                '    <option value="-1">Choose Account Type</option>' +
                '' +
                '    @foreach($controlledgers as $controlledger)' +
                '        <option value="{{$controlledger->id}}">{{$controlledger->name}}</option>' +
                '    @endforeach' +
                '' +
                '</select>' +
                '                        </div>' +
                '                        <div class="col-md-8">' +
                '<div class="col-md-4">' +
                '    <div class="form-group">' +
                '        <label>Amount</label>' +
                '        <input type="" name="amount[]" class="form-control" id="amount[]"' +
                '               aria-describedby="" placeholder="Enter Amount">' +
                '    </div>' +
                '</div>' +
                '' +
                '<div class="col-md-4">' +
                '    <div class="form-group">' +
                '        <label>Amount Type</label>' +
                '        <select class="custom-select form-control" id="amount_type[]" name="amount_type[]">' +
                '            <option value="-1">Choose Amount Type</option>' +
                '            <option value="1">credit</option>' +
                '            <option value="2">debit</option>' +
                '' +
                '        </select>' +
                '    </div>' +
                '</div>' +

                '        <button type="button" id="remove" name="remove" class="btn btn-primary remove_field_button " style="margin-top: 25px">- </button>' +
                '    </div>' +

                '                   </div>     </div>');

        });


        $("body").on("click", ".remove_field_button", function (e) {
            $(this).parents('.input_fields ').remove();
        });

    </script>
@endsection
@section('topleft')
    Debit create
    <small>Control panel</small>
@endsection
@section('topright')
    Debit
@endsection
