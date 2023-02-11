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
            <strong>Create Slider</strong>
        </li>
    </ol>
    <h2>Create Slider</h2>
    <br />
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-body">
                    <form method="post" action="{{url('admin/slider/store')}}" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="upload" class="col-sm-3 control-label">Image: </label>
                            <div class="col-sm-5">
                                <input type="file" id="upload" name="upload" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-5">
                                <input type="submit" class="btn btn-success" value="Create Slider">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
