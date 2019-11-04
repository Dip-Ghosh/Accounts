@extends('layouts.admin.master')
@section('title','Income Year Create')
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


                <form method="POST" action="{{route('income.store')}}">

                    @CSRF
                    @method('POST')

                    <div class="form-group">
                        <label>Date</label>
                        <input  name="incomeYear" class="form-control datepicker-years" id="incomeYear"
                               aria-describedby="" placeholder="Enter Year">
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('#incomeYear').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years"
            });
        });
    </script>
    @endsection
@section('topleft')

   Income Year create
    <small>Control panel</small>
@endsection
@section('topright')
    Income Year
@endsection
