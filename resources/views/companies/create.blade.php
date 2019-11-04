@extends('layouts.admin.master')
@section('title','Company  Create')
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


                <form method="POST" action="{{route('company.store')}}" enctype="multipart/form-data">

                    @CSRF
                    @method('POST')

                    <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby=""
                               placeholder="Enter Company Name">
                    </div>


                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" id="address" aria-describedby=""
                               placeholder="Enter Address">
                    </div>

                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="number" name="mobile" class="form-control" id="mobile" aria-describedby=""
                               placeholder="Enter Mobile Number">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby=""
                               placeholder="Enter Email Address">
                    </div>

                    <div class="form-group">
                        <label for="logo"> Image</label>
                        <input type="file" name="logo" class="form-control" id="logo"/>
                        <p class="help-block">Image must be jpeg,png,jpg,gif,svg and max file size 2M.</p>
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>

@endsection

@section('topleft')
    Company  create
    <small>Control panel</small>
@endsection
@section('topright')
    Company
@endsection
