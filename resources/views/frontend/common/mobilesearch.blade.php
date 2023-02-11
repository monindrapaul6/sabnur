<!--== Start Aside Search Menu ==-->
<aside class="aside-search-box-wrapper offcanvas offcanvas-top" data-bs-scroll="true" tabindex="-1" id="AsideOffcanvasSearch">
    <div class="offcanvas-header">
        <h5 class="d-none" id="offcanvasTopLabel">Aside Search</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">×</button>
    </div>
    <div class="offcanvas-body">
        <div class="container pt--0 pb--0">
            <div class="search-box-form-wrap">
                <div class="search-note">
                    <p>Start typing and press Enter to search</p>
                </div>
                <form action="{{url('search')}}" method="get">
                    <div class="search-form position-relative">
                        <label for="mobileq" class="visually-hidden">Search</label>
                        <input id="mobileq" name="q" type="search" class="form-control" placeholder="Search products" autocomplete="off">
                        <button class="search-button" type="button"><i class="fa fa-search"></i></button>
                    </div>
                    <div class="MfloatingLiveSearch border shadow" id="MfloatingLive" style="display: none">

                        <h5>Products</h5>
                        <hr/>
                        <div id="Mresultitems"></div>
                    </div>

                    <style>
                        .MfloatingLiveSearch{
                            position: absolute;
                            z-index: 1999;
                            width: 350px;
                            background-color: #fff;
                            padding: 25px 15px;
                            max-height: 550px;
                            overflow: scroll;
                        }
                        .MfloatingLiveSearch .floatingLiveSearchItem h6{
                            color: #111111;
                            font-size: 12px;
                            font-weight: 500;
                        }
                        .MfloatingLiveSearch .floatingLiveSearchItem strong{
                            color: #000;
                            font-size: 12px;
                            font-weight: 600;
                        }
                    </style>

                    <script type="text/javascript">
                        $(document).ready(function (){
                            $('#MfloatingLive').hide();
                            $('#mobileq').on('keyup',function(){
                                $value=$(this).val();
                                var strlength = $(this).val().length;

                                if(strlength > 2) {
                                    $('#MfloatingLive').show();
                                    $.ajax({
                                        type: 'get',
                                        url: '{{URL::to('api/livesearch')}}',
                                        data: {'q': $value},
                                        success: function (data) {
                                            $('#Mresultitems').html(data);
                                        }
                                    });
                                }
                                else{
                                    $('#Mresultitems').html('');
                                    $('#MfloatingLive').hide();
                                }

                            });
                            $('.btn-close').click(function (){
                                $('#mobileq').val('');
                                $('#Mresultitems').html('');
                                $('#MfloatingLive').hide();
                            });
                            $('body').click(function() {
                                $('#Mresultitems').html('');
                                $('#MfloatingLive').hide();
                            });
                        });
                    </script>
                    <script type="text/javascript">
                        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
                    </script>
                </form>
            </div>
        </div>
    </div>
</aside>
<!--== End Aside Search Menu ==-->
