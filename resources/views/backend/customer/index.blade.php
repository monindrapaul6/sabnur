@extends('backend.layout.app')
@section('content')

        <ol class="breadcrumb bc-3" >
            <li>
                <a href="{{url('/')}}"><i class="fa-home"></i>Home</a>
            </li>
            <li>
                <a href="{{url('admin/customers')}}">Customers</a>
            </li>
        </ol>

        <h3>Staffs</h3>
        <br>
        <a href="{{url('admin/customer/create')}}" class="btn btn-success">Add customer</a>
        <br />
        <table class="table table-bordered datatable" id="table-1">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{$customer->id}}</td>
                <td><strong>{{$customer->name}}</strong></td>
                <td>{{$customer->mobile}}</td>
                <td>{{$customer->email}}</td>
                <td><a href="{{url('admin/customer/'.$customer->id)}}" class="btn btn-success">Action</a></td>
            </tr>
            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
        <br />
@endsection
