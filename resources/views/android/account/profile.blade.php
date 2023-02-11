@extends('android.layout.app')
@section('content')

    <div class="headerInfo">
        <div class="col-12">
            <div>
                <a href="{{url('/account')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                    <span>Profile</span>
                </a>
            </div>
        </div>
    </div>
    
    
    <div class="section" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="container myAccount">
            <div class="row">
                <div class="col-12 mt-3">
                    <h3>Update Profile</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <form id="myForm" class="formSection mt-4" action="{{url('accountUpdate')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{Auth::user()->id}}">

                        <div class="col-12 mb-3">
                            <label for="mobile">Mobile</label>
                            <input type="text" class="formInput" id="mobile" value="{{$account->mobile}}" disabled />
                        </div>

                        <div class="col-12 mb-3">
                            <label for="name">Name</label>
                            <span class="text-danger" id="errMsgContact"></span>
                            <input type="text" class="formInput" id="name" name="name" value="{{$account->name}}" />
                        </div>

                        <div class="col-12 mb-3">
                            <label for="email">Email</label>
                            <span class="text-danger" id="errMsgStreet"></span>
                            <input type="email" class="formInput" id="email" name="email" value="{{$account->email}}" />
                        </div>

                        <div class="col-12 mb-3">
                            <button class="submitBtn" id="submitBtn">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
