@extends('layouts.admin.master')
@section('title','Company  Edit')
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


                <form method="POST" action="{{route('company.update',$company->id)}}" enctype="multipart/form-data">

                    @CSRF
                    @method('put')


                    <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby=""
                               value="{{$company->name}}">
                    </div>


                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" id="address" aria-describedby=""
                               value="{{$company->address}}">
                    </div>

                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="number" name="mobile" class="form-control" id="mobile" aria-describedby=""
                               value="{{$company->mobile}}">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby=""
                               value="{{$company->email}}">
                    </div>
                    <div class="form-group">
                        <label for="image"> Image</label>
                        <input type="file" name="logo" class="form-control" id="logo"/>
                        <p class="help-block">Image must be jpeg,png,jpg,gif,svg and max file size 2M.</p>

                        <div>
                            <img width="150px" id="image_path" alt="image"
                                 src="{{ asset('images/company_image/'.$company->logo) }}">

                        </div>


                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>

@endsection

@section('topleft')
    Company  Edit
    <small>Control panel</small>
@endsection
@section('topright')
    Company
@endsection
