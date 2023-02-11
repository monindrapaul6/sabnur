@extends('frontend.layout.app')
@section('content')

    <h1>Create Address</h1>

    <form action="{{url('/address/store')}}" method="post">
        @csrf
        <p>
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
        </p>
        <p>
            <label for="contact_no">Contact No</label>
            <input type="text" name="contact_no" id="contact_no">
        </p>
        <p>
            <label for="street">Street</label>
            <input type="text" name="street" id="street">
        </p>
        <p>
            <label for="city">City</label>
            <input type="text" name="city" id="city">
        </p>
        <p>
            <label for="country">Country</label>
            <input type="text" name="country" id="country">
        </p>
        <p>
            <label for="state">State</label>
            <select name="state" id="state">
                <option value="0">Select State</option>
                @foreach($states as $state)
                    <option value="{{$state->id}}">{{$state->state_name}}</option>
                @endforeach
            </select>
        </p>
        <p>
            <label for="zip">zip</label>
            <input type="text" name="zip" id="zip">
        </p>
        <p>
            <label for="locality">locality</label>
            <input type="text" name="locality" id="locality">
        </p>
        <p>
            <label for="landmark">landmark</label>
            <input type="text" name="landmark" id="landmark">
        </p>
        <p>
            <input type="submit" value="Create Address"/>
        </p>
    </form>


@endsection
