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
                                <h3>Address</h3>
                                <!--<div class="col-12 bg-gray-light py-3 text-center" onclick='window.location.href="/account/address/create"' style="cursor: pointer"> + Add New</div>-->
                                <button class="col-12 bg-gray-light py-3 border-0 text-center" id="createBtnAdd"> + Add New</button>

                                <div class="col-12">
                                    <div class="myaccount-content" id="createAddressForm" style="display: none">
                                        <h3>Create Address</h3>
                                        <form id="myForm" class="account-details-form mt-4">
                                            <input type="hidden" name="targetUrl" id="targetUrl" value="{{$targetUrl}}">
                                            <div class="single-input-item">
                                                <label for="name" class="required">Name</label>
                                                <input type="text" id="name" name="name" value="{{old('name')}}" />
                                                <span class="text-danger" id="errMsgName"></span>
                                            </div>
                                            <div class="single-input-item">
                                                <label for="contact_no" class="required">Contact No</label>
                                                <input type="text" id="contact_no" name="contact_no" value="{{old('contact_no')}}" />
                                                <span class="text-danger" id="errMsgContact"></span>
                                            </div>
                                            <div class="single-input-item">
                                                <label for="street" class="required">Street</label>
                                                <input type="text" id="street" name="street" value="{{old('street')}}" />
                                                <span class="text-danger" id="errMsgStreet"></span>
                                            </div>
                                            <div class="single-input-item">
                                                <label for="city" class="required">City</label>
                                                <input type="text" id="city" name="city" value="{{old('city')}}" />
                                                <span class="text-danger" id="errMsgCity"></span>
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
                                                <span class="text-danger" id="errMsgState"></span>
                                            </div>
                                            <div class="single-input-item">
                                                <label for="locality" class="required">Locality</label>
                                                <input type="text" id="locality" name="locality" value="{{old('locality')}}" />
                                            </div>
                                            <div class="single-input-item">
                                                <label for="zip" class="required">Pin Code</label>
                                                <input type="text" id="zip" name="zip" value="{{old('zip')}}" />
                                                <span class="text-danger" id="errMsgZip"></span>
                                            </div>
                                            <div class="single-input-item">
                                                <label for="landmark" class="required">Landmark</label>
                                                <input type="text" id="landmark" name="landmark" value="{{old('landmark')}}" />
                                            </div>
                                            <div class="single-input-item">
                                                <button class="check-btn sqr-btn" id="submitBtn">
                                                    <span id="loadingMsg">
                                                        <img src="/static/images/loader.gif" width="20" height="20" class="mr-3"/>
                                                        Creating Address...
                                                    </span>
                                                    <span id="unloadingMsg">
                                                        Create Address
                                                    </span>
                                                </button>
                                                <span class="badge bg-warning" style="float: right; cursor: pointer" id="cancelBtn">Cancel</span>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                @foreach($addresses as $address)
                                    <div class="col-12 border-bottom py-3">
                                    <address class="defaultAddress">
                                        <p><strong>{{$address->name}}</strong></p>
                                        <p>{{$address->street}} {{$address->city}}, {{$address->locality}} <br>
                                            {{$address->state}}, {{$address->zip}}, {{$address->country}}<br/>
                                            {{$address->landmark}}
                                        </p>
                                        <p>Mobile: {{$address->contact_no}}</p>
                                    </address>
                                        <a href="{{url('/account/address/' . $address->id)}}" class="text-primary"> Edit | </a>
                                        <a href="{{url('/account/address/' . $address->id . '/delete')}}" class="text-primary"> Remove </a>
                                        @if($address->is_primary == false)
                                            <a href="{{url('/account/address/' . $address->id . '/default')}}" class="text-primary"> | Set As Primary</a>
                                        @endif
                                    </div>
                            @endforeach
                            <!--Links-->
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
        .dot {
            height: 15px;
            width: 15px;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
    <script>
        $(document).ready(function (){
            $('#loadingMsg').hide();
            $('#unloadingMsg').show();

            $('#createBtnAdd').click(function (){
                $('#createAddressForm').show();
            });
            $('#cancelBtn').click(function (){
                $('#myForm')[0].reset();
                $('#createAddressForm').hide();
            });

            $('#submitBtn').click(function (e) {
                e.preventDefault();

                $('#errMsgName').text("");
                $('#errMsgContact').text("");
                $('#errMsgStreet').text("");
                $('#errMsgCity').text("");
                $('#errMsgState').text("");
                $('#errMsgZip').text("");

                var formData = {
                    user_id: {{Auth::user()->id}},
                    name: $('#name').val(),
                    contact_no: $('#contact_no').val(),
                    street: $('#street').val(),
                    city: $('#city').val(),
                    country: $('#country').val(),
                    state: $('#state').val(),
                    state_code: $('#state_code').val(),
                    zip: $('#zip').val(),
                    locality: $('#locality').val(),
                    landmark: $('#landmark').val(),
                    targetUrl: $('#targetUrl').val()
                };

                $.ajax({
                    type: 'POST',
                    url: '/api/createAddress',
                    data: formData,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#loadingMsg').show();
                        $('#unloadingMsg').hide();
                        $("#submitBtn").prop('disabled', true);
                    },
                    success: function (response) {
                        if(response.status === 200){
                            $('#myForm')[0].reset();
                            //console.log(response);
                            window.location.href = '/' + response.targetUrl
                        }
                        if(response.status === 'failed'){
                            $('#errMsgName').text(response.validation_error.name);
                            $('#errMsgContact').text(response.validation_error.contact_no);
                            $('#errMsgStreet').text(response.validation_error.street);
                            $('#errMsgCity').text(response.validation_error.city);
                            $('#errMsgState').text(response.validation_error.state);
                            $('#errMsgZip').text(response.validation_error.zip);
                        }
                        $('#loadingMsg').hide();
                        $('#unloadingMsg').show();
                        $("#submitBtn").prop('disabled', false); // enable button
                    },
                    error: function (error) {
                        console.log(error)
                    }
                })
            })
        });
    </script>
@endsection
