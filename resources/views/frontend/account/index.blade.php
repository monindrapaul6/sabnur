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
                                    <a class="myaccount-nav-link active" href="{{url('/account')}}">Dashboard</a>
                                    <a class="myaccount-nav-link" href="{{url('account/orders')}}"> Orders</a>
                                    <a class="myaccount-nav-link" href="{{url('account/address')}}">Address</a>
                                    <a class="myaccount-nav-link" href="{{url('account/sell')}}">Sell Devices</a>
                                    <a class="myaccount-nav-link" href="{{url('logout')}}">Logout</a>
                                </nav>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="myaccount-content">
                                    <h3>Dashboard</h3>
                                    <div class="welcome">
                                        <p>Hello, <strong>{{Auth::user()->name}}</strong> (If Not <strong>{{Auth::user()->name}} !</strong><a href="{{url('logout')}}" class="logout"> Logout</a>)</p>
                                    </div>
                                    <p class="mb-0">From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                                    <form class="account-details-form mt-4" action="{{url('accountUpdate')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                        <div class="single-input-item">
                                            <label for="display-name" class="required">Mobile</label>
                                            <input type="text" id="display-name" value="{{$account->mobile}}" disabled/>
                                        </div>
                                        <div class="single-input-item">
                                            <label for="display-name" class="required">Name</label>
                                            <input type="text" id="display-name" name="name" value="{{$account->name}}"/>
                                        </div>
                                        <div class="single-input-item">
                                            <label for="email" class="required">Email Addres</label>
                                            <input type="email" id="email" name="email" value="{{$account->email}}" />
                                        </div>
                                        <div class="single-input-item">
                                            <button class="check-btn sqr-btn">Save Changes</button>
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

@endsection
