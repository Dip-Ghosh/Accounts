@extends('layouts.admin.master')
@section('title','Control Ledger  Edit')
@section('content')

    <div class="content" style="padding: 10px 150px 10px 150px ">

        <div class="box box-success box-body">
            <div class="formtxt">

                <div class="box-header with-border">
                    <div>
                        @if($message = Session::get('success'))
                            <div class="alert alert-primary alert-dismissible">{{ $message }}</div>
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


                <form method="POST" action="{{route('controlLedger.update',$controlLedger->id)}}" >

                    @CSRF
                    @method('put')



                    <div class="form-group">
                        <label>Control  Ledger Name</label>
                        <input type="numebr" name="code" class="form-control" id="code" aria-describedby=""
                               value="{{$controlLedger->code}}">
                    </div>

                    <div class="form-group">
                        <label>Ledger Name</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby=""
                               value="{{$controlLedger->name}}">
                    </div>


                    <div class="form-group">
                        <label>Control Ledger Descriptions </label>
                        <textarea type="text" class="form-control" id="description" name="description" rows="10" cols="80"  placeholder="Enter Ladger Name">   {{$controlLedger->description}}</textarea>

                    </div>

                    <div class="form-group">
                        <label>Ledger Group Ledger</label>
                        <select class="custom-select form-control" id="group_ledger_id" name="group_ledger_id">
                            <option value="-1">Choose Group Ledger</option>

                            @foreach($ledgers as $ledger)
                                @if($ledger['id'] == $controlLedger->group_ledger_id)
                                <option selected value="{{$ledger->id}}" >{{$ledger->name}} </option>

                                @else
                                    <option  value="{{$ledger->id}}" >{{$ledger->name}} </option>
                                @endif
                            @endforeach

                        </select>
                    </div>


                    <div class="form-group">
                        <label>Sub Group Ledger</label>
                        <select class="custom-select form-control" id="sub_group_ledger_id" name="sub_group_ledger_id">
                            <option value="-1">Choose Sub Group Ledger</option>

                            @foreach($sub_group_ledgers as $sub_group_ledger)
                                @if($sub_group_ledger['id'] == $controlLedger->sub_group_ledger_id)
                                    <option selected value="{{$sub_group_ledger->id}}" >{{$sub_group_ledger->name}} </option>

                                @else
                                    <option  value="{{$sub_group_ledger->id}}" >{{$sub_group_ledger->name}} </option>
                                @endif
                            @endforeach

                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>

        </div>
    </div>

@endsection

@section('topleft')
   Control Ledger  Edit
    <small>Control panel</small>
@endsection
@section('topright')
    Control Ledger
@endsection
