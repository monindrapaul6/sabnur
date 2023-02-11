<div class="billing-info-wrap bg-white shadow px-4 py-2 mb-3">

    <?php
    $getAddress = Auth::user()->userDefaultAddress;
    ?>

    <h4>Delivery Address @isset($getAddress)<img src="{{asset('static/images/checkmark.png')}}" width="14" height="14" class="pl-3"/>@endisset</h4>

    <div class="row">

            <div id="userFtAddress">
            @if(isset($getAddress))
                <div class="col-12 mt-3">
                    <div class="">
                        <span class="badge btn-secondary float-end" id="changeAddress" style="display: none">Change</span>
                        <h5 id="dfAddHead">{{$getAddress->name}} - {{$getAddress->contact_no}}</h5>
                        <p id="dtAddPara">{{$getAddress->street . ', ' . $getAddress->city . ', ' . $getAddress->locality . ', ' . $getAddress->city . ', ' . $getAddress->state . ' - ' . $getAddress->zip}}</p>
                    </div>
                </div>
            @else
                <div class="col-12 mt-3">
                    <div class="col-12 bg-gray-light py-3 text-center" onclick='window.location.href="/account/address/create?targetUrl=checkout"' style="cursor: pointer"> + Add New Address</div>
                </div>
            @endif
            </div>

            <div id="allUserAddress" style="display: none">
            @if(count($user->user_addresses) > 0)
                @foreach($user->user_addresses as $address)
                    <div class="col-12">
                        <div class="billing-info mb-4">
                            <input type="radio" name="address_id" class="selectAddress" value="{{$address->id}}" id="{{'address' . $address->id}}"
                                {{$address->is_primary == true ? 'checked' : null}}>
                            <label for="{{'address' . $address->id}}">
                                <h5>{{$address->name . ' - ' . $address->contact_no}}</h5>
                                <p>{{$address->street . ', ' . $address->city . ', ' . $address->locality . ', ' . $address->city . ', ' . $address->state . ' - ' . $address->zip}}</p>
                            </label>
                        </div>
                    </div>
                @endforeach
            @else
                <a href="{{url('/account/address/create?targetUrl=checkout')}}">Create address</a>
            @endif
            <span class="btn btn-primary" id="selectAddress">Deliver Here</span>
            </div>
    </div>
</div>

<script>
    $(document).ready(function (){
        $('#changeAddress').click(function (){
            $('#userFtAddress').hide();
            $('#allUserAddress').show();
        });

        $('#selectAddress').click(function (){
            $.ajax({
                url:'api/setDefaultAddress',
                data:{
                    'id': $('input[class=selectAddress]:checked').val(),
                    'user_id': "{{Auth::user()->id}}"
                },
                type:'post',
                success:  function (response) {
                    $('#userFtAddress').show();
                    $('#allUserAddress').hide();

                    $('#dfAddHead').html(response.defaultAddress.name + ' - ' + response.defaultAddress.contact_no);
                    $('#dtAddPara').html(response.defaultAddress.street + ', ' + response.defaultAddress.city + ', ' + response.defaultAddress.locality + ', ' + response.defaultAddress.city + ', ' + response.defaultAddress.state + ' - ' + response.defaultAddress.zip);
                },
                error:function(x,xs,xt){
                    window.open(JSON.stringify(x));
                }
            });
        });
    });
</script>
