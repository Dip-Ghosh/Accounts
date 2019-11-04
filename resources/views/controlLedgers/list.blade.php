@extends('layouts.admin.master')
@section('title','Control  Ledger  list')
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
                                <th scope="col">Group Ledger</th>
                                <th scope="col">Sub Group Ledger</th>
                                <th scope="col">Descriptions</th>
                                <th scope="col">Action</th>


                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach($controlLedgers as $controlLedger)
                                <tr>

                                    <td>{{$i++}}</td>
                                    <td>{{$controlLedger->code}}</td>
                                    <td>{{$controlLedger->name}}</td>
                                    <td>{{$controlLedger->gname}}</td>
                                    <td>{{$controlLedger->sname}}</td>
                                    <td>{{$controlLedger->description}}</td>



                                    <td>
                                        <form action="{{ route('controlLedger.destroy',$controlLedger->id)}}" method="POST">
                                            <a href="{{route('controlLedger.edit',$controlLedger->id)}}"
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
                                <th scope="col">Group Ledger</th>
                                <th scope="col">Sub Group Ledger</th>
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
        Control  Ledger List
        <small>Control panel</small>
    </h1>
@endsection
@section('topright')
    Control  Ledger List
@endsection
