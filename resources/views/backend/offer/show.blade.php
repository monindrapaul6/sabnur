@extends('backend.layout.app')
@section('content')

        <ol class="breadcrumb bc-3" >
            <li>
                <a href="{{url('/admin')}}"><i class="fa-home"></i>Home</a>
            </li>
            <li>
                <a href="{{url('admin/offers')}}">Offers</a>
            </li>
            <li class="active">
                <strong>{{$offer->offer_name}}</strong>
            </li>
        </ol>

        <h2>{{$offer->offer_name}}</h2>
        <br />
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary" data-collapsed="0">
                    <div class="panel-body">
                        <form role="form" method="post" action="{{url('admin/offer/update')}}" class="form-horizontal form-groups-bordered">
                            @csrf
                            <input type="hidden" name="id" value="{{$offer->id}}">

                            <div class="form-group">
                                <label for="offer_name" class="col-sm-3 control-label">Offer Name: </label>
                                @if ($errors->has('offer_name'))
                                    <span class="text-danger">{{ $errors->first('offer_name') }}</span>
                                @endif
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="offer_name" name="offer_name" value="{{$offer->offer_name}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="offer_type" class="col-sm-3 control-label">Offer Type: </label>
                                @if ($errors->has('offer_type'))
                                    <span class="text-danger">{{ $errors->first('offer_type') }}</span>
                                @endif
                                <div class="col-sm-5">
                                    <select class="form-control" id="offer_type" name="offer_type">
                                        <option value="flat" @if($offer->offer_type == 'flat') selected @endif>Flat</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="offer_value" class="col-sm-3 control-label">Offer Value: </label>
                                @if ($errors->has('offer_value'))
                                    <span class="text-danger">{{ $errors->first('offer_value') }}</span>
                                @endif
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="offer_value" name="offer_value" value="{{$offer->offer_value}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="offer_expiry" class="col-sm-3 control-label">Offer Start: </label>
                                @if ($errors->has('offer_start'))
                                    <span class="text-danger">{{ $errors->first('offer_start') }}</span>
                                @endif
                                <div class="col-sm-5">
                                    <input type="text" class="form-control datepicker" data-format="dd-mm-yyyy" id="offer_start" name="offer_start" value="{{\Carbon\Carbon::parse($offer->offer_start)->format('d-m-Y')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="offer_expiry" class="col-sm-3 control-label">Offer Expiry: </label>
                                @if ($errors->has('offer_expiry'))
                                    <span class="text-danger">{{ $errors->first('offer_expiry') }}</span>
                                @endif
                                <div class="col-sm-5">
                                    <input type="text" class="form-control datepicker" data-format="dd-mm-yyyy" id="offer_expiry" name="offer_expiry" value="{{\Carbon\Carbon::parse($offer->offer_expiry)->format('d-m-Y')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status" class="col-sm-3 control-label">Status: </label>
                                <div class="col-sm-2">
                                    <select name="status" id="status" class="form-control">
                                        <option value="ACTIVE" @if($offer->status == 'ACTIVE') selected @endif>ACTIVE</option>
                                        <option value="INACTIVE" @if($offer->status == 'INACTIVE') selected @endif>INACTIVE</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-7">
                                    <input type="submit" class="btn btn-success" value="Save">
                                </div>
                                <div class="col-sm-5">
                                    <a class="text-right" href="{{url('/admin/offer/' . $offer->id . '/delete')}}">Delete</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
