@extends('frontend.layout.app')
@section('content')
    <main class="main-content">
    @include('frontend.dashboard.topsearch')
        @include('frontend.dashboard.topslidersection')
        @include('frontend.dashboard.middlebanner')
        <!--middleitems-->
        <!--topcategories-->
    @include('frontend.dashboard.newarrivals')
    @include('frontend.dashboard.brand')
        @include('frontend.dashboard.bestsellers')
    @include('frontend.dashboard.bestdeals')
        <!--bottombanner-->


        <!--newletter-->

    </main>
@endsection
