@extends('backend.layout.app')
@section('content')

        <ol class="breadcrumb bc-3" >
            <li>
                <a href="{{url('/admin')}}"><i class="fa-home"></i>Home</a>
            </li>
            <li>
                <a href="{{url('admin/charges')}}">Charges</a>
            </li>
            <li class="active">
                <strong>{{$charge->id}}</strong>
            </li>
        </ol>

        <h2>{{$charge->id}}</h2>
        <br />
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary" data-collapsed="0">
                    <div class="panel-body">
                        <form role="form" method="post" action="{{url('admin/charge/update')}}" class="form-horizontal form-groups-bordered">
                            @csrf
                            <input type="hidden" name="id" value="{{$charge->id}}">

                            <div class="form-group">
                                <label for="shipping_charge" class="col-sm-3 control-label">Shipping Charge: </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="shipping_charge" name="shipping_charge" value="{{$charge->shipping_charge}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="shipping_total_limit" class="col-sm-3 control-label">Shopping Total Limit: </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="shipping_total_limit" name="shipping_total_limit" value="{{$charge->shipping_total_limit}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cod_charge" class="col-sm-3 control-label">COD Charge: </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="cod_charge" name="cod_charge" value="{{$charge->cod_charge}}">
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
