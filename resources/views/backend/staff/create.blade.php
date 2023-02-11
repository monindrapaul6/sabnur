@extends('backend.layout.app')
@section('content')

    <ol class="breadcrumb bc-3" >
        <li>
            <a href="{{url('/')}}"><i class="fa-home"></i>Home</a>
        </li>
        <li>
            <a href="{{url('admin/staffs')}}">Staffs</a>
        </li>
        <li class="active">
            Create Staff
        </li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-body">
                    <form role="form" action="{{url('admin/staff/store')}}" method="post" class="form-horizontal form-groups-bordered">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Staff Name</label>
                            <div class="col-sm-5">
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mobile" class="col-sm-3 control-label">Staff Mobile</label>
                            @if ($errors->has('mobile'))
                                <span class="text-danger">{{ $errors->first('mobile') }}</span>
                            @endif
                            <div class="col-sm-5">
                                <input type="text" name="mobile" id="mobile" class="form-control" value="{{old('mobile')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Staff Email</label>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                            <div class="col-sm-5">
                                <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="permission" class="col-sm-3 control-label">Role</label>
                            <div class="col-sm-5">
                                <select name="permission" id="permission" class="form-control">
                                    <option value="ADMIN">ADMIN</option>
                                    <option value="MANAGER">MANAGER</option>
                                    <option value="CUSTOMER">CUSTOMER</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Staff Password</label>
                            <div class="col-sm-5">
                                <input type="text" name="password" id="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5">
                                <input type="submit" class="btn btn-success" value="Create Staff">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
