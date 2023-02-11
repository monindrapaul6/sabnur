@extends('backend.layout.app')
@section('content')

        <ol class="breadcrumb bc-3" >
            <li>
                <a href="{{url('/')}}"><i class="fa-home"></i>Home</a>
            </li>
            <li>
                <a href="{{url('admin/staffs')}}">Staffs</a>
            </li>
        </ol>

        <h3>Staffs</h3>
        <br>
        <a href="{{url('admin/staff/create')}}" class="btn btn-success">Add Staff</a>
        <br />
        <table class="table table-bordered datatable" id="table-1">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Permission</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($staffs as $staff)
            <tr>
                <td>{{$staff->id}}</td>
                <td><strong>{{$staff->name}}</strong></td>
                <td>{{$staff->mobile}}</td>
                <td>{{$staff->email}}</td>
                <td>
                    @if($staff->permission == 'ADMIN') <span class="badge badge-primary">Admin</span>@endif
                        @if($staff->permission == 'MANAGER') <span class="badge badge-success">MANAGER</span>@endif
                </td>
                <td><a href="{{url('admin/staff/'.$staff->id)}}" class="btn btn-success">Action</a></td>
            </tr>
            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Permission</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
        <br />
@endsection
