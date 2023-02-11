@extends('backend.layout.app')
@section('content')

    <ol class="breadcrumb bc-3" >
        <li>
            <a href="{{url('/admin')}}"><i class="fa-home"></i>Home</a>
        </li>
        <li>
            <a href="{{url('admin/statecodes')}}">State Code</a>
        </li>
        <li class="active">
            <strong>Create State Code</strong>
        </li>
    </ol>
    <h2>Create State Code</h2>
    <br />
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-body">
                    <form method="post" action="{{url('admin/statecode/store')}}" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="state_name" class="col-sm-3 control-label">State Name: </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="state_name" name="state_name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="state_code" class="col-sm-3 control-label">State Code: </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="state_code" name="state_code" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-5">
                                <input type="submit" class="btn btn-success" value="Save">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
