@extends('layouts.admin.master')
@section('title','Bank Account')
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
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

                <form method="POST" action="{{route('bankAccount.store')}}">

                    @CSRF
                    @method('POST')


                    <div class="form-group">
                        <label> Name</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby=""
                               placeholder="Enter Account Name">
                    </div>

                    <div class="form-group">
                        <label>Contact No</label>
                        <input type="text" name="mobile" class="form-control" id="mobile" aria-describedby=""
                               placeholder="Enter Contact Number">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby=""
                               placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" id="address" aria-describedby=""
                               placeholder="Enter Address">
                    </div>

                    <div class="form-group">
                        <label>Bank</label>
                        <select class="custom-select form-control" id="bank_id" name="bank_id">
                            <option value="-1">Choose Bank</option>
                            @foreach($banks as $bank)
                                <option value="{{$bank->id}}">{{$bank->name}} </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Bank Branch</label>
                        <select class="custom-select form-control" id="branch_id" name="branch_id">
                            <option value="-1">Choose Branch Bank</option>
                            @foreach($bank_branches as $bank_branch)
                                <option value="{{$bank_branch->id}}">{{$bank_branch->name}} </option>
                            @endforeach

                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>
@endsection
@section('topleft')

    Bank Account create
    <small>Control panel</small>
@endsection
@section('topright')
    Bank Account
@endsection
