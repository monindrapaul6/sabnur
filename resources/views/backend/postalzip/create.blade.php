@extends('backend.layout.app')
@section('content')

    <ol class="breadcrumb bc-3" >
        <li>
            <a href="{{url('/admin')}}"><i class="fa-home"></i>Home</a>
        </li>
        <li>
            <a href="{{url('admin/postalzips')}}">All Postal Zips</a>
        </li>
        <li class="active">
            <strong>Create Postal Zip</strong>
        </li>
    </ol>
    <h2>Create Postal Zip</h2>
    <br />
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-body">
                    <form method="post" action="{{url('admin/postalzip/store')}}" class="form-horizontal form-groups-bordered">
                        @csrf
                        <div class="form-group">
                            <label for="zip_code" class="col-sm-3 control-label">Zip Code: </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="zip_code" name="zip_code" required>
                            </div>
                        </div>

                        <div class="form-group d-none">
                            <label for="is_delivery" class="col-sm-3 control-label">Is Delivery Available: </label>
                            <div class="col-sm-5">
                                <select name="is_delivery" id="is_delivery" class="form-control">
                                    <option value="YES">YES</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group d-none">
                            <label for="is_cod" class="col-sm-3 control-label">Is COD Available: </label>
                            <div class="col-sm-5">
                                <select name="is_cod" id="is_cod" class="form-control">
                                    <option value="YES">YES</option>
                                    <option value="NO">NO</option>
                                </select>
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
