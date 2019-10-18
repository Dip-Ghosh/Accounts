@extends('master')

@section('content')

    <section class="content-header">
        <h1>
            Slider List
        </h1>
    </section>
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
                                <th>SL</th>
                                <th>Slider Name</th>
                                <th>Image</th>
                                <th>Published</th>
                                <th>Created by</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $slider)
                                <tr>
                                    <td>{{$slider['id']}}</td>
                                    <td>{{$slider['name']}}</td>
                                    <td>
                                        @if($images=\App\SliderImage::where('slider_id','=',$slider['id'])->get())
                                            @foreach($images as $image)
                                                <img width="80px" alt="image" src="{{ asset('images/sliderImage/'.$image['image_path']) }}">
                                            @endforeach
                                        @endif

                                    </td>
                                    <td>{{ ($slider['published'] == '1') ? 'Yes' : 'No' }}</td>
                                    <td>{{$slider->created_By}}</td>
                                    <td>{{$slider->created_at}}</td>
                                    <td>
                                        <form action="{{route('slider.destroy',$slider['id'])}}" method="POST">
                                            <a href="{{route('slider.edit',$slider['id'])}}" class="btn btn-sm btn-success">Edit</a>

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
                                <th>SL</th>
                                <th>Slider Name</th>
                                <th>Image</th>
                                <th>Published</th>
                                <th>Created by</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection

