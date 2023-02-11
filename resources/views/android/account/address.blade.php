@extends('android.layout.app')
@section('content')

<div class="headerInfo">
        <div class="col-12">
            <div>
                <a href="{{url('/account')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                    <span>Address</span>
                </a>
            </div>
        </div>
    </div>

<div class="section" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="container myAccount">
        <div class="row justify-content-center">
            
            <div class="col-12">
                <h3><a href="{{url('/account/address/create')}}">Add a new address</a></h2>
            </div>
            
            <div class="col-12 mt-3">
                <h3>My Address</h3>
            </div>
            
            @foreach($addresses as $address)
            <div class="col-12 AddressItem">
                <h3>{{$address->name}}</h3>
                <p>
                    {{$address->street}} {{$address->city}}, {{$address->locality}} <br>
                    {{$address->state}}, {{$address->zip}}, {{$address->country}}<br />
                    {{$address->landmark}}
                </p>
                <p><strong>Contact: {{$address->contact_no}}</strong></p>

                <div class="col-12 all_btn" >
                    <button class="btn1" href="{{url('/account/address/' . $address->id)}}">Edit</button>
                    @if($address->is_primary == false)
                        <button class="btn2" href="">Primary</button>
                    @endif
                    <button class="btn3" href="{{url('/account/address/' . $address->id . '/default')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </button>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>

@endsection