@extends('layouts.admin.master')
@section('title','Control  Ledger  Create')
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


                <form method="POST" action="{{route('controlLedger.store')}}">

                    @CSRF
                    @method('POST')

                    <div class="form-group">
                        <label> Control Ledger code</label>
                        <input type="number" name="code" class="form-control" id="code" aria-describedby=""
                               placeholder="Enter control Ledger code">
                    </div>


                    <div class="form-group">
                        <label>Control Ledger Name </label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby=""
                               placeholder="Enter control Ladger Name">
                    </div>

                    <div class="form-group">
                        <label> Control Ledger Descriptions </label>
                        <textarea type="text" class="form-control" id="description" name="description" rows="10"
                                  cols="80" placeholder="Enter control Ladger Name">  </textarea>

                    </div>
                    <div class="form-group">
                        <label>Group Ledger</label>
                        <select class="custom-select form-control" id="group_ledger_id" name="group_ledger_id">
                            <option value="-1">Choose Group Ledger</option>
                            @foreach($ledgers as $ledger)
                                <option value="{{$ledger->id}}">{{$ledger->name}} </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sub Group Ledger</label>
                        <select class="custom-select form-control" id="sub_group_ledger_id"
                                name="sub_group_ledger_id">
                            <option value="-1">Choose Sub Group Ledger</option>
                            @foreach($sub_group_ledgers as $sub_group_ledger)
                                <option value="{{$sub_group_ledger->id}}">{{$sub_group_ledger->name}} </option>
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
    Control  Ledger create
    <small>Control panel</small>
@endsection
@section('topright')
    Control  Ledger
@endsection
