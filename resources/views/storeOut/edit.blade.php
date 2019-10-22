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
                        <label>InVoice Id </label>
                        <input type="text" name="invoice_no" class="form-control" id="invoice_no" aria-describedby=""
                               value="{{$storeOuts->invoice_no}}">
                    </div>

                    <div class="form-group">
                        <label>Customer</label>
                        <input type="text" name="customer_info" class="form-control" id="customer_info" aria-describedby=""
                               value="{{$storeOuts->customer_info}}">
                    </div>

                    <div class="form-group">
                        <label>Note</label>
                        <textarea type="text" name="note" class="form-control" id="note" aria-describedby=""
                                  rows="3" cols="250"  >{{$storeOuts->note}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input  data-date-format="yyyy-mm-dd" name="date" class="form-control" id="date"
                                value="{{$storeOuts->date}}" >
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{asset('https://code.jquery.com/jquery-3.4.1.min.js')}}" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {

            // $('#date').
            $('#date').datepicker('setDate', 'today');
        });
    </script>
@endsection

@section('topleft')
    Store Out   Edit
    <small>Control panel</small>
@endsection
@section('topright')
    Store Out
@endsection
