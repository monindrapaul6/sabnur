@extends('frontend.layout.applight')
@section('content')

    <main class="main-content">

        <!--== Start My Account Wrapper ==-->
        <div class="account-area section-space">
            <div class="container">
                <div class="myaccount-page-wrapper">
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <nav class="myaccount-tab-menu nav nav-tabs">
                                <a class="myaccount-nav-link" href="{{url('/account')}}">Dashboard</a>
                                <a class="myaccount-nav-link" href="{{url('account/orders')}}"> Orders</a>
                                <a class="myaccount-nav-link active" href="{{url('account/address')}}">Address</a>
                                <a class="myaccount-nav-link" href="{{url('account/sell')}}">Sell Devices</a>
                                <a class="myaccount-nav-link" href="{{url('logout')}}">Logout</a>
                            </nav>
                        </div>
                        <div class="col-lg-9 col-md-8">
                            <div class="myaccount-content">
                                <h3>Create Address</h3>
                                <form class="account-details-form mt-4" action="{{url('account/address/store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="targetUrl" value="{{$targetUrl}}">
                                    <div class="single-input-item">
                                        <label for="name" class="required">Name</label>
                                        <input type="text" id="name" name="name" value="{{old('name')}}" />
                                    </div>
                                    <div class="single-input-item">
                                        <label for="contact_no" class="required">Contact No</label>
                                        <input type="text" id="contact_no" name="contact_no" value="{{old('contact_no')}}" />
                                    </div>
                                    <div class="single-input-item">
                                        <label for="street" class="required">Street</label>
                                        <input type="text" id="street" name="street" value="{{old('street')}}" />
                                    </div>
                                    <div class="single-input-item">
                                        <label for="city" class="required">City</label>
                                        <input type="text" id="city" name="city" value="{{old('city')}}" />
                                    </div>
                                    <div class="single-input-item">
                                        <label for="country" class="required">Country</label>
                                        <input type="text" id="country" name="country" value="{{old('country')}}" />
                                    </div>
                                    <div class="single-input-item">
                                        <label for="state" class="required">State</label>
                                        <select name="state" id="state" class="selectItem">
                                            <option value="0">Select State</option>
                                            @foreach($states as $state)
                                                <option value="{{$state->id}}" @if(old('state') == $state->id) selected @endif>{{$state->state_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="single-input-item">
                                        <label for="locality" class="required">Locality</label>
                                        <input type="text" id="locality" name="locality" value="{{old('locality')}}" />
                                    </div>
                                    <div class="single-input-item">
                                        <label for="zip" class="required">Pin Code</label>
                                        <input type="text" id="zip" name="zip" value="{{old('zip')}}" />
                                    </div>
                                    <div class="single-input-item">
                                        <label for="landmark" class="required">Landmark</label>
                                        <input type="text" id="landmark" name="landmark" value="{{old('landmark')}}" />
                                    </div>
                                    <div class="single-input-item">
                                        <button class="check-btn sqr-btn">Create Address</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End My Account Wrapper ==-->
    </main>
    <style>
        .myaccount-content{
            font-size: 15px;
            line-height: 20px;
            font-weight: 500;
        }
    </style>
@endsection
