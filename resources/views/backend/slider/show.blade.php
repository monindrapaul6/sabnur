@extends('backend.layout.app')
@section('content')

        <ol class="breadcrumb bc-3" >
            <li>
                <a href="{{url('/admin')}}"><i class="fa-home"></i>Home</a>
            </li>
            <li>
                <a href="{{url('admin/sliders')}}">Sliders</a>
            </li>
            <li class="active">
                <strong>{{$slider->id}}</strong>
            </li>
        </ol>

        <h2>{{$slider->id}}</h2>
        <br />
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary" data-collapsed="0">
                    <div class="panel-body">
                        <form role="form" method="post" action="{{url('admin/slider/update')}}" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$slider->id}}">

                            <div class="form-group">
                                <label for="brand_image_thumb" class="col-sm-3 control-label">Image: </label>
                                <div class="col-sm-5">
                                    <img src="{{asset($slider->SliderPicture->image_thumb)}}" width="175" height="auto">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="upload" class="col-sm-3 control-label">Change Image: </label>
                                <div class="col-sm-5">
                                    <input type="file" id="upload" name="upload" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status" class="col-sm-3 control-label">Status: </label>
                                <div class="col-sm-2">
                                    <select name="status" id="status" class="form-control">
                                        <option value="ACTIVE" @if($slider->status == 'ACTIVE') selected @endif>ACTIVE</option>
                                        <option value="INACTIVE" @if($slider->status == 'INACTIVE') selected @endif>INACTIVE</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-5">
                                    <input type="submit" class="btn btn-success" value="Save">
                                </div>
                                <div class="col-sm-5">
                                    <a href="{{url('admin/slider/' . $slider->id . '/delete')}}" class="text-danger float-right">Delete</a>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>

            </div>
        </div>
@endsection
