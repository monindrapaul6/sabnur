<!--== Search ==-->
<div class="product-categories-area mt-3 d-block d-sm-block d-md-none d-lg-none">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="topSearchbar">
                    <form action="{{url('search')}}" method="get">
                        <i class="icon-magnifier"></i>
                        <input type="text" id="homeq" name="q" placeholder="Search Products" autocomplete="off">
                        <div class="header-search-box-categories">
                        </div>
                        <button type="submit"></button>
                        <div class="HfloatingLiveSearch border shadow" id="HfloatingLive" style="display: none">

                            <h5>Products</h5>
                            <hr/>
                            <div id="Hresultitems"></div>
                        </div>
                        <style>
                            .HfloatingLiveSearch{
                                position: absolute;
                                margin-top: 28px;
                                z-index: 1999;
                                width: 350px;
                                background-color: #fff;
                                padding: 25px 15px;
                                max-height: 550px;
                                overflow: scroll;
                            }
                            .HfloatingLiveSearch .floatingLiveSearchItem h6{
                                color: #111111;
                                font-size: 12px;
                                font-weight: 500;
                            }
                            .HfloatingLiveSearch .floatingLiveSearchItem strong{
                                color: #000;
                                font-size: 12px;
                                font-weight: 600;
                            }
                        </style>

                        <script type="text/javascript">
                            $(document).ready(function (){
                                $('#HfloatingLive').hide();
                                $('#homeq').on('keyup',function(){
                                    $value=$(this).val();
                                    var strlength = $(this).val().length;

                                    if(strlength > 2) {
                                        $('#HfloatingLive').show();
                                        $.ajax({
                                            type: 'get',
                                            url: '{{URL::to('api/livesearch')}}',
                                            data: {'q': $value},
                                            success: function (data) {
                                                $('#Hresultitems').html(data);
                                            }
                                        });
                                    }
                                    else{
                                        $('#Hresultitems').html('');
                                        $('#HfloatingLive').hide();
                                    }

                                });
                            });
                            $('body').click(function() {
                                $('#Hresultitems').html('');
                                $('#HfloatingLive').hide();
                            });
                        </script>
                        <script type="text/javascript">
                            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--== End Search ==-->
<style>
    .topSearchbar{
        margin-bottom: 20px;
    }
    .topSearchbar form{
        background: #efefef;
        display: flex;
        padding: 3px 5px;
        border-radius: 6px;
    }
    .topSearchbar i{
        padding-top: 8px;
        padding-left: 4px;
        padding-right: 8px;
    }
    .topSearchbar input[type=text]{
        width: 100%;
        background-color: transparent;
        font-size: 13px;
        font-weight: 500;
        border: 0;
        color: #333333;
    }
    .topSearchbar input[type=text]:focus{
        outline: none;
    }
    .topSearchbar button{
        border: none;
        background:none;
    }
</style>
