@extends('layouts.admin.master')
@section('title','Customer  Edit')

@section('content')

    <div class="content">

        <div class="box box-success box-body ">


            <form method="post" action="{{route('customer.update',$customers->id)}}">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Customer Name</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby=""
                           value="{{$customers->name}}">
                </div>

                <div class="form-group">
                    <label>Contact No</label>
                    <input type="text" name="mobile" class="form-control" id="mobile" aria-describedby=""
                         value="{{$customers->mobile}}">
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby=""
                           value="{{$customers->email}}">
                </div>

                <button type="submit" class="btn btn-primary ">Update</button>
            </form>
            <br>


        </div>
    </div>


@endsection
@section('topleft')

    Customer    <small>Control panel</small>
@endsection
@section('topright')
    Customer  edit
@endsection
