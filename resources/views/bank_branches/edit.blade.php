@extends('layouts.admin.master')
@section('title','Bank Branch  Edit')

@section('content')

    <div class="content" style="padding: 10px 150px 10px 150px ">

        <div class="box box-success box-body ">
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

                <form method="post" action="{{route('bankBranch.update',$bank_branch->id)}}">

                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label> Name</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby=""
                               value="{{$bank_branch->name}}">
                    </div>

                    <div class="form-group">
                        <label>Contact No</label>
                        <input type="text" name="mobile" class="form-control" id="mobile" aria-describedby=""
                               value="{{$bank_branch->mobile}}">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby=""
                               value="{{$bank_branch->email}}">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" id="address" aria-describedby=""
                               value="{{$bank_branch->address}}">
                    </div>



                    <button type="submit" class="btn btn-primary ">Update</button>
                </form>
                <br>
            </div>


        </div>
    </div>


@endsection
@section('topleft')

    Bank Branch   <small>Control panel</small>
@endsection
@section('topright')
    Bank Branch edit
@endsection
