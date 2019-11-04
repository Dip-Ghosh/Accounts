@extends('layouts.admin.master')
@section('title','Ledger Group  list')
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
                                <th scope="col">Code</th>
                                <th scope="col">Name</th>
                                <th scope="col">Descriptions</th>
                                <th scope="col">Action</th>


                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach($ledgers as $ledger)
                                <tr>

                                    <td>{{$i++}}</td>
                                    <td>{{$ledger->code}}</td>
                                    <td>{{$ledger->name}}</td>
                                    <td>{{$ledger->description}}</td>



                                    <td>
                                        <form action="{{ route('ledger.destroy',$ledger->id)}}" method="POST">
                                            <a href="{{route('ledger.edit',$ledger->id)}}"
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
                                <th scope="col">Code</th>
                                <th scope="col">Name</th>
                                <th scope="col">Descriptions</th>
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
        Ledger Group List
        <small>Control panel</small>
    </h1>
@endsection
@section('topright')
    Ledger Group  List
@endsection
