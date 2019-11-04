@extends('layouts.admin.master')
@section('title','Ledger  Edit')
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


                <form method="POST" action="{{route('ledger.update',$ledgers->id)}}" >

                    @CSRF
                    @method('put')



                    <div class="form-group">
                        <label>Ledger Name</label>
                        <input type="numebr" name="code" class="form-control" id="code" aria-describedby=""
                               value="{{$ledgers->code}}">
                    </div>

                    <div class="form-group">
                        <label>Ledger Name</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby=""
                               value="{{$ledgers->name}}">
                    </div>


                    <div class="form-group">
                        <label>Ledger Descriptions </label>
                        <textarea type="text" class="form-control" id="description" name="description" rows="10" cols="80"  placeholder="Enter Ladger Name">   {{$ledgers->description}}</textarea>

                    </div>



                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>

        </div>
    </div>

@endsection

@section('topleft')
    Ledger  Edit
    <small>Control panel</small>
@endsection
@section('topright')
    Ledger
@endsection
