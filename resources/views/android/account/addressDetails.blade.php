<nav class="myaccount-tab-menu nav nav-tabs">
    <a class="myaccount-nav-link" href="{{url('/account')}}">Dashboard</a>
    <a class="myaccount-nav-link" href="{{url('account/orders')}}"> Orders</a>
    <a class="myaccount-nav-link active" href="{{url('account/address')}}">Address</a>
    <a class="myaccount-nav-link" href="{{url('account/sell')}}">Sell Devices</a>
    <a class="myaccount-nav-link" href="{{url('logout')}}">Logout</a>
</nav>

<h3>Update Address</h3>
<form class="account-details-form mt-4" action="{{url('account/address/update')}}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$address->id}}">
    <div class="single-input-item">
        <label for="name" class="required">Name</label>
        <input type="text" id="name" name="name" value="{{$address->name}}" />
    </div>
    <div class="single-input-item">
        <label for="contact_no" class="required">Contact No</label>
        <input type="text" id="contact_no" name="contact_no" value="{{$address->contact_no}}" />
    </div>
    <div class="single-input-item">
        <label for="street" class="required">Street</label>
        <input type="text" id="street" name="street" value="{{$address->street}}" />
    </div>
    <div class="single-input-item">
        <label for="city" class="required">City</label>
        <input type="text" id="city" name="city" value="{{$address->city}}" />
    </div>
    <div class="single-input-item">
        <label for="country" class="required">Country</label>
        <input type="text" id="country" name="country" value="{{$address->country}}" />
    </div>
    <div class="single-input-item">
        <label for="state" class="required">State</label>
        <select name="state" id="state" class="selectItem">
            <option value="0">Select State</option>
            @foreach($states as $state)
                <option value="{{$state->id}}" @if($state->state_code == $address->state_code) selected @endif>{{$state->state_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="single-input-item">
        <label for="locality" class="required">Locality</label>
        <input type="text" id="locality" name="locality" value="{{$address->locality}}" />
    </div>
    <div class="single-input-item">
        <label for="zip" class="required">Pin Code</label>
        <input type="text" id="zip" name="zip" value="{{$address->zip}}" />
    </div>
    <div class="single-input-item">
        <label for="landmark" class="required">Landmark</label>
        <input type="text" id="landmark" name="landmark" value="{{$address->landmark}}" />
    </div>
    <div class="single-input-item">
        <button class="check-btn sqr-btn">Save Address</button>
    </div>
</form>
