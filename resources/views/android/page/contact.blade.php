@extends('android.layout.app')
@section('content')

<div class="section" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="container myPage">
        <div class="row">
            <div class="col-12 mt-3">
                <h3>Contact</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mt-3 mb-5">
                <h4 class="mb-4">Sabnur Plant & Nursery</h4>
                <p>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        </svg>
                    </span>1no Rail Gate, Habra, North 24 Parganas, West Bengal - 743263</p>
                <p>
                <a href="tel:8013647571">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                        </svg>
                    </span>+91 8013647571
                </a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3 mb-5">
                <h5 class="mb-4">Have you any query</h5>

                <div class="col-12">
                <form id="myForm" class="formSection mt-4" action="{{ url('/contact') }}" method="post">
                    @csrf
                    
                    <div class="col-12 mb-3">
                        <label for="name">Name</label>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <input type="text" class="formInput" id="name" name="name" value="{{old('name')}}" />
                    </div>
                    
                    <div class="col-12 mb-3">
                        <label for="mobile">Mobile</label>
                        @if ($errors->has('mobile'))
                            <span class="text-danger">{{ $errors->first('mobile') }}</span>
                        @endif
                        <input type="text" class="formInput" id="mobile" name="mobile" value="{{old('mobile')}}" />
                    </div>
                    
                    <div class="col-12 mb-3">
                        <label for="email">Email</label>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                        <input type="text" class="formInput" id="email" name="email" value="{{old('email')}}" />
                    </div>
                    
                    <div class="col-12 mb-3">
                        <label for="details">Details</label>
                        @if ($errors->has('details'))
                            <span class="text-danger">{{ $errors->first('details') }}</span>
                        @endif
                        <textarea class="formInput" id="details" name="details">{{old('details')}}</textarea>
                    </div>
                    
                    <div class="col-12 mb-3">
                        <button class="submitBtn" id="submitBtn" type="submit">Submit Request</button>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </form>
            </div>
                
            </div>
        </div>
    </div>
</div>


@endsection