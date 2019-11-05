@extends('layouts.admin.master')
@section('title','Bank Account  Edit')

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
            <form method="post" action="{{route('bankAccount.update',$bank_account->id)}}">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label> Name</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby=""
                           value="{{$bank_account->name}}">
                </div>

                <div class="form-group">
                    <label>Contact No</label>
                    <input type="text" name="mobile" class="form-control" id="mobile" aria-describedby=""
                           value="{{$bank_account->mobile}}">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby=""
                           value="{{$bank_account->email}}">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" id="address" aria-describedby=""
                           value="{{$bank_account->address}}">
                </div>

                <div class="form-group">
                    <label>Bank</label>
                    <select class="custom-select form-control" id="bank_id" name="bank_id">
                        <option value="-1">Choose Bank</option>
                        @foreach($banks as $bank)
                            @if($bank->id === $bank_account->bank_id)
                                <option selected value="{!! $bank['id']!!}">{!!$bank['name']!!}</option>
                            @else
                                <option value="{!! $bank['id']!!}">{!!$bank['name']!!}</option>
                            @endif
                        @endforeach

                    </select>
                </div>


                <div class="form-group">
                    <label>Bank Branch</label>
                    <select class="custom-select form-control" id="branch_id" name="branch_id">
                        <option value="-1">Choose  Bank Branch</option>
                        @foreach($bank_branches as $bank_branch)
                            @if($bank_branch->id === $bank_account->branch_id)
                                <option selected value="{!! $bank_branch['id']!!}">{!!$bank_branch['name']!!}</option>
                            @else
                                <option value="{!! $bank_branch['id']!!}">{!!$bank_branch['name']!!}</option>
                            @endif
                        @endforeach

                    </select>
                </div>



                <button type="submit" class="btn btn-primary ">Update</button>
            </form>
            <br>
            </div>
        </div>
    </div>


@endsection
@section('topleft')

    Bank Account    <small>Control panel</small>
@endsection
@section('topright')
    Bank Account  edit
@endsection
