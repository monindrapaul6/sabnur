@extends('frontend.layout.app')
@section('content')

    <!--== Start Divider Area ==-->
        <div class="divider-area section-space">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9 border shadow rounded sellDeviceDetails" style="padding: 35px 12px;">
                        <div class="col-3 col-md-4 py-3 text-center float-start">
                            <img src="{{asset($sellDevice->sellDeviceItem->device_image)}}" width="150" height="auto"/>
                        </div>
                        <div class="col-9 col-md-8 px-2 py-3 float-start">
                            <h2>{{$sellDevice->sellDeviceItem->device_name}}</h2>
                            <p>Get Maximum price ever on <span>Aplus Device</span></p>
                            <h6>Variant: {{$sellDevice->variant}}</h6>
                            <p class="mt-5 d-none d-md-block">
                                <button class="btn btn-primary" onclick='window.location.href="#devicePicture"'>Upload Pictures & Get Maximum Value</button>
                                <span class="px-3" style="cursor: pointer" onclick='window.location.href="/selldevice/{{$sellDevice->id}}/complete"'>Skip</span>
                            </p>
                        </div>
                        <div class="col-12 d-block d-md-none float-start">
                            <button class="btn btn-primary" onclick='window.location.href="#devicePicture"'>Upload Pictures & Get Maximum Value</button>
                            <span class="px-3" style="cursor: pointer" onclick='window.location.href="/selldevice/{{$sellDevice->id}}/complete"'>Skip</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== Stop Divider Area ==-->
        <!--== Start Divider Area ==-->
        <div class="divider-area mb-5">
            <div class="container" id="devicePicture">
                <form method="POST" enctype="multipart/form-data" id="image-upload" action="javascript:void(0)" >
                    <input type="hidden" name="id" value="{{$sellDevice->id}}">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-9 border shadow rounded sellDeviceDetails" style="padding: 35px 0">
                            <div class="col-12 px-4 py-5">
                                <div class="form-group">
                                    <h3>Upload Images</h3>
                                    <input type="file" name="images" placeholder="Choose image" id="images" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-12 mb-2 d-flex px-4" id="getImages">
                                @foreach($sellDevice->sellDevicePictures as $picture)
                                    <div class="col-1 px-2 py-2 preview-image">
                                        <img src="{{asset($picture->image_thumb)}}">
                                        <span style="cursor: pointer" onclick="myFunc({{$sellDevice->id}}, {{$picture->id}})">Delete</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-12 px-4">
                                <button type="button" class="btn btn-primary" id="submit" onclick='window.location.href="/selldevice/{{$sellDevice->id}}/complete"'>Submit</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!--== Stop Divider Area ==-->
    <style>
        .preview-image img
        {
            padding: 10px;
            max-width: 100px;
        }
    </style>
    <script type="text/javascript">
        function myFunc(sell_id, picture_id){
            var x = confirm('Are you sure?');
            if(x === true) {
                window.location.href = '/selldeleteimage/' + sell_id + '/' + picture_id
            }
            else{
                return false;
            }
        }

        $(document).ready(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#image-upload').change(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type:'POST',
                    url: "{{ url('api/DeviceuploadPicture')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        location.reload();
                        //this.reset();
                        //alert('Image has been uploaded using jQuery ajax successfully');
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endsection
