@extends('frontend.layout.app')
@section('content')

    <h1>Address</h1>

    @foreach($addresses as $address)
        <p>
            {{$address->id . ' - ' . $address->city}}
        </p>
    @endforeach


@endsection
