@extends('layouts.admin.master')
@section('title','Product Type Edit')

@section('content')

    <div class="content">

        <div class="box box-success box-body ">


            <form method="post" action="{{route('productType.update',$types->id)}}">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Product Type</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby=""
                           placeholder="Enter Product Type Name" value="{{$types->name}}">
                </div>

                <button type="submit" class="btn btn-primary ">Update</button>
            </form>
            <br>


        </div>
    </div>


@endsection
@section('topleft')

    Product Type Edit
    <small>Control panel</small>
@endsection
@section('topright')
    Product Type edit
@endsection
