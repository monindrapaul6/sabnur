@extends('android.layout.app')
@section('content')

<div class="section" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="container myAccount">
        <div class="row">
            <div class="col-12 mt-3">
                <h3>Create New Address</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form id="myForm" class="formSection mt-4">
                    <input type="hidden" name="targetUrl" id="targetUrl" value="{{$targetUrl}}">
                    
                    <div class="col-12 mb-3">
                        <label for="name">Name</label>
                        <span class="text-danger" id="errMsgName"></span>
                        <input type="text" class="formInput" id="name" name="name" value="{{old('name')}}" />
                    </div>
                    
                    <div class="col-12 mb-3">
                        <label for="contact_no">Contact No</label>
                        <span class="text-danger" id="errMsgContact"></span>
                        <input type="text" class="formInput" id="contact_no" name="contact_no" value="{{old('contact_no')}}" />
                    </div>
                    
                    <div class="col-12 mb-3">
                        <label for="street">Street</label>
                        <span class="text-danger" id="errMsgStreet"></span>
                        <input type="text" class="formInput" id="street" name="street" value="{{old('street')}}" />
                    </div>
                    
                    <div class="col-12 mb-3">
                        <label for="city">City</label>
                        <span class="text-danger" id="errMsgCity"></span>
                        <input type="text" class="formInput" id="city" name="city" value="{{old('city')}}" />
                    </div>
                    
                    <div class="col-12 mb-3">
                        <label for="country">Country</label>
                        <select class="formInput" id="country" name="country">
                            <option value="India">India</option>
                        </select>
                    </div>
                    
                    <div class="col-12 mb-3">
                        <label for="state">State</label>
                        <span class="text-danger" id="errMsgState"></span>
                        <select name="state" id="state" class="formInput">
                            <option value="0">Select State</option>
                            @foreach($states as $state)
                                <option value="{{$state->id}}" @if(old('state')==$state->id) selected @endif>{{$state->state_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-12 mb-3">
                        <label for="locality" class="required">Locality</label>
                        <input type="text" class="formInput" id="locality" name="locality" value="{{old('locality')}}" />
                    </div>

                    <div class="col-12 mb-3">
                        <label for="zip">Pin Code</label>
                        <span class="text-danger" id="errMsgZip"></span>
                        <input type="text" class="formInput" id="zip" name="zip" value="{{old('zip')}}" />
                    </div>
                    
                    <div class="col-12 mb-3">
                        <label for="landmark">Landmark</label>
                        <input type="text" class="formInput" id="landmark" name="landmark" value="{{old('landmark')}}" />
                    </div>
                    
                    <div class="col-12 mb-3">
                        <button class="submitBtn" id="submitBtn">
                            <span id="loadingMsg">
                                <img src="/static/images/loader.gif" width="20" height="20" class="mr-3" />
                                Creating Address...
                            </span>
                            <span id="unloadingMsg">
                                Create Address
                            </span>
                        </button>
                        <span class="badge bg-warning" style="float: right; cursor: pointer; margin-top: 20px;" id="cancelBtn">Cancel</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('#loadingMsg').hide();
        $('#unloadingMsg').show();

        $('#cancelBtn').click(function () {
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
                user_id: {{ Auth:: user() -> id
        }},
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
        beforeSend: function () {
            $('#loadingMsg').show();
            $('#unloadingMsg').hide();
            $("#submitBtn").prop('disabled', true);
        },
        success: function (response) {
            if (response.status === 200) {
                $('#myForm')[0].reset();
                //console.log(response);
                window.location.href = '/' + response.targetUrl
            }
            if (response.status === 'failed') {
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