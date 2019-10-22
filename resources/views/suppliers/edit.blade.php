@extends('layouts.admin.master')
@section('title','Supplier  Edit')

@section('content')

    <div class="content">

        <div class="box box-success box-body ">


            <form method="post" action="{{route('supplier.update',$suppliers->id)}}">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Supplier Name</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby=""
                           value="{{$suppliers->name}}">
                </div>

                <div class="form-group">
                    <label>Contact No</label>
                    <input type="text" name="mobile" class="form-control" id="mobile" aria-describedby=""
                         value="{{$suppliers->mobile}}">
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" id="address" aria-describedby=""
                           value="{{$suppliers->address}}">
                </div>

                <button type="submit" class="btn btn-primary ">Update</button>
            </form>
            <br>


        </div>
    </div>


@endsection
@section('topleft')

    Supplier  Edit
    <small>Control panel</small>
@endsection
@section('topright')
    Supplier  edit
@endsection
