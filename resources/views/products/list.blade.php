@extends('layouts.admin.master')
@section('title','Product Type list')
@section('content')

    <section class="content-header">
        <h1>
            Product Type
            <small>Unit's Info Here</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Unit</li>
        </ol>
    </section>

    <br>


    <div class="content">

        <div class="box box-success box-body ">

            <div class="formtxt">

                @if(count($errors)>0)

                    <ul>
                        @foreach($errors->all() as $error)

                            <li class="alert alert-danger">{{$error}}</li>

                        @endforeach
                    </ul>

                @endif


                @if(session()->has('message'))

                    <div class="">

                        <div class="alert alert-success">

                            <button type="button" class="close" data-dismiss="alert" aira-hidden="true">
                                &times;
                            </button>
                            <strong>Unit</strong>
                            {{session()->get('message')}}

                        </div>


                    </div>

                @endif
            </div>

            <div class="tabletxt">

                <table class="table">

                    <thead>
                    <tr>
                        <th scope="col">Serial No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>

                    </tr>
                    </thead>
                    <tbody>

                    @php
                    $i=1;
                    @endphp
                    @foreach($types as $type)
                        <tr>

                            <td>{{$i++}}</td>
                            <td>{{$type->name}}</td>

                            <td>
                                <form action="{{ route('productType.destroy',$type->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-primary alert-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                                </form>
                            <a class="btn btn-primary alert-success" href="{{route('productType.edit',$type->id)}}">Edit</a>
                            </td>

                        </tr>
                    @endforeach


                    </tbody>
                </table>

            </div>


        </div>
    </div>


@endsection
@section('top')
    Product Type List
@endsection
