@extends('layouts.admin.master')
@section('title','Income Year Edit')

@section('content')

    <div class="content">

        <div class="box box-success box-body ">


            <form method="post" action="{{route('income.update',$income->id)}}">

                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Date</label>
                    <input  name="incomeYear" class="form-control datepicker-years" id="incomeYear"
                         value="{{$income->incomeYear}}" aria-describedby="">
                </div>

                <button type="submit" class="btn btn-primary ">Update</button>
            </form>
            <br>


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

    Income Year Edit
    <small>Control panel</small>
@endsection
@section('topright')
    Income Year edit
@endsection
