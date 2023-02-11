@extends('android.layout.app')
@section('content')

<div class="section" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="container myAccount">
        <div class="row">
            <div class="col-12">
                <h1>My Account</h1>
            </div>

            <div class="col-12">
                <a href="{{url('account/profile')}}">
                    <div class="accountItem bg1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#fff"
                            class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        </svg>
                        <h2>Profile</h2>
                    </div>
                </a>
                <a href="{{url('account/orders')}}">
                    <div class="accountItem bg2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path
                                d="M3 10h18v10.004c0 .55-.445.996-.993.996H3.993A.994.994 0 0 1 3 20.004V10zm6 2v2h6v-2H9zM2 4c0-.552.455-1 .992-1h18.016c.548 0 .992.444.992 1v4H2V4z"
                                fill="rgba(255,255,255,1)" />
                        </svg>
                        <h2>Order</h2>
                    </div>
                </a>
                <a href="{{url('account/address')}}">
                    <div class="accountItem bg3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path
                                d="M17.084 15.812a7 7 0 1 0-10.168 0A5.996 5.996 0 0 1 12 13a5.996 5.996 0 0 1 5.084 2.812zM12 23.728l-6.364-6.364a9 9 0 1 1 12.728 0L12 23.728zM12 12a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"
                                fill="rgba(255,255,255,1)" />
                        </svg>
                        <h2>Address</h2>
                    </div>
                </a>
                <a href="{{url('contact')}}">
                    <div class="accountItem bg4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path
                                d="M21 16.42v3.536a1 1 0 0 1-.93.998c-.437.03-.794.046-1.07.046-8.837 0-16-7.163-16-16 0-.276.015-.633.046-1.07A1 1 0 0 1 4.044 3H7.58a.5.5 0 0 1 .498.45c.023.23.044.413.064.552A13.901 13.901 0 0 0 9.35 8.003c.095.2.033.439-.147.567l-2.158 1.542a13.047 13.047 0 0 0 6.844 6.844l1.54-2.154a.462.462 0 0 1 .573-.149 13.901 13.901 0 0 0 4 1.205c.139.02.322.042.55.064a.5.5 0 0 1 .449.498z"
                                fill="rgba(255,255,255,1)" />
                        </svg>
                        <h2>Contact</h2>
                    </div>
                </a>
                <a href="{{url('account/feedback')}}">
                    <div class="accountItem bg5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path
                                d="M6.455 19L2 22.5V4a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H6.455zM11 13v2h2v-2h-2zm0-6v5h2V7h-2z"
                                fill="rgba(255,255,255,1)" />
                        </svg>
                        <h2>Feedback</h2>
                    </div>
                </a>
                <a href="{{url('logout')}}">
                    <div class="accountItem bg6">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path
                                d="M5 22a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5zm10-6l5-4-5-4v3H9v2h6v3z"
                                fill="rgba(255,255,255,1)" />
                        </svg>
                        <h2>Logout</h2>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection