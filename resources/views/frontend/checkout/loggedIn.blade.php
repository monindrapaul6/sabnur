<div class="billing-info-wrap bg-white shadow px-4 py-2 mb-3">
    <h4>Login <img src="{{asset('static/images/checkmark.png')}}" width="14" height="14" class="pl-3"/></h4>
    <div class="row">
        <div class="col-12">
            <div class="">
                {{Auth::user()->name}}: <strong>{{Auth::user()->mobile}}</strong>
            </div>
        </div>

    </div>
</div>
