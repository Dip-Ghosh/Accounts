@extends('layouts.admin.master')
@section('title','Company  list')
@section('content')



    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        @if($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible">{{ $message }}</div>
                        @endif
                    </div>
                    <div class="box-body">
                        <table id="pageList" class="table table-bordered table-striped table-responsive">
                            <thead>
                            <tr>
                                <th scope="col">Serial No</th>
                                <th scope="col">Name
                                <th scope="col">Address</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mobile No</th>
                                <th scope="col">Company Logo</th>
                                <th scope="col">Action</th>


                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach($companies as $company)
                                <tr>

                                    <td>{{$i++}}</td>
                                    <td>{{$company->name}}</td>
                                    <td>{{$company->address}}</td>
                                    <td>{{$company->email}}</td>
                                    <td>{{$company->mobile}}</td>
                                    <td><img src="{{asset('images/company_image/'.$company->logo)}}" width="100px"
                                             height="100px"></td>

                                    <td>
                                        <form action="{{ route('company.destroy',$company->id)}}" method="POST">
                                            <a href="{{route('company.edit',$company->id)}}"
                                               class="btn btn-sm btn-success">Edit</a>

                                            @CSRF
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure to delete?')">Delete
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th scope="col">Serial No</th>
                                <th scope="col">Name
                                <th scope="col">Address</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mobile No</th>
                                <th scope="col">Company Logo</th>
                                <th scope="col">Action</th>
                            </tr>
                            </tfoot>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection

@section('js')
    <script>
        $(function () {

            $('#pageList').DataTable();
        });

    </script>
@endsection
@section('topleft')
    <h1>
        Company List
        <small>Control panel</small>
    </h1>
@endsection
@section('topright')
    Company  List
@endsection
