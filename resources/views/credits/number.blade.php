@extends('layouts.admin.master')
@section('title','Credit  Create')
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


                <form id="form">
                    <div class="form-group">
                        <label> Type</label>
                        <input type="" name="number" id="number">

                            <button  type="submit"
                                     class="btn btn-primary " style="margin-left: 10px; ">Submit
                            </button>

                    </div>






                        <div class="form-group"   >



                                    <table border="2px"  >

                                        <tr align="center">
                                            <th scope="col">In words</th>
                                        </tr>
                                        <tr>
                                            <td  name="num" id="num">

                                            </td>
                                        </tr>
                                    </table>


                        </div>


                </form>



            </div>

        </div>
    </div>


@endsection

@section('js')
    <script>


        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });

        $(document).ready(function (e) {
            $('#form').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '{{route('credit.num2english')}}',
                    data:{  "_token": "{{ csrf_token() }}",
                        number: $("input#number").val()},

                    success: function (data) {

                        $('#num').append('<p></p>').empty();
                        $('#num').append('<p>'+data+'</p>');
                    }
                });
            });
        });
    </script>
@endsection
@section('topleft')
    Credit create
    <small>Control panel</small>
@endsection
@section('topright')
    Credit
@endsection
