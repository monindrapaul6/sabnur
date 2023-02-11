@extends('backend.layout.app')
@section('content')

    <ol class="breadcrumb bc-3" >
        <li>
            <a href="{{url('/')}}"><i class="fa-home"></i>Home</a>
        </li>
        <li>
            <a href="{{url('admin/customers')}}">Customers</a>
        </li>
        <li class="active">
            {{$customer->id}}
        </li>
    </ol>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-body">
                    <form role="form" action="{{url('admin/customer/update')}}" method="post" class="form-horizontal form-groups-bordered">
                        @csrf
                        <input type="hidden" name="id" value="{{$customer->id}}">
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Staff Name</label>
                            <div class="col-sm-5">
                                <input type="text" name="name" id="name" value="{{$customer->name}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mobile" class="col-sm-3 control-label">Staff Mobile</label>
                            @if ($errors->has('mobile'))
                                <span class="text-danger">{{ $errors->first('mobile') }}</span>
                            @endif
                            <div class="col-sm-5">
                                <input type="text" name="mobile" id="mobile" value="{{$customer->mobile}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Staff Email</label>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                            <div class="col-sm-5">
                                <input type="email" name="email" id="email" value="{{$customer->email}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="permission" class="col-sm-3 control-label">Role</label>
                            <div class="col-sm-5">
                                <select name="permission" id="permission" class="form-control">
                                    <option value="ADMIN" @if($customer->permission == 'ADMIN') selected @endif>ADMIN</option>
                                    <option value="MANAGER" @if($customer->permission == 'MANAGER') selected @endif>MANAGER</option>
                                    <option value="CUSTOMER" @if($customer->permission == 'CUSTOMER') selected @endif>CUSTOMER</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-5">
                                <select name="status" id="status" class="form-control">
                                    <option value="ACTIVE" @if($customer->status == 'ACTIVE') selected @endif>Active</option>
                                    <option value="INACTIVE" @if($customer->status == 'INACTIVE') selected @endif>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Change Password</label>
                            <div class="col-sm-5">
                                <input type="email" name="password" id="password" class="form-control">
                                (Leave blank if no need to change password)
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5">
                                <input type="submit" class="btn btn-success" value="Update Staff Info">
                            </div>
                            <div class="col-sm-7 text-right">
                                <a href="{{ url('admin/customer/'.$customer->id.'/delete') }}" class="btn btn-danger">Delete Customer</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-body">
                    <h3>Addresses</h3>
                    <div class="form-group">
                        <table class="table table-bordered datatable" id="table-1">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Contact No</th>
                                <th>Address</th>
                                <th>Primary</th>
                            </tr>
                            @foreach($customer->user_addresses as $address)
                            <tr>
                                <td>{{$address->id}}</td>
                                <td>{{$address->name}}</td>
                                <td>{{$address->contact_no}}</td>
                                <td>{{$address->street . ' ' . $address->city. ' ' . $address->country . ' ' . $address->state . ' ' . $address->zip . ' ' . $address->locality . ' ' . $address->landmarh}}</td>
                                <td>{{$address->is_primary == true ? 'YES' : 'NO'}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
