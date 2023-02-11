@extends('backend.layout.app')
@section('content')

    <ol class="breadcrumb bc-3" >
        <li>
            <a href="{{url('/')}}"><i class="fa-home"></i>Home</a>
        </li>
        <li class="active">
            All Images
        </li>
    </ol>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-body">
                    <div class="form-group">
                        @if(count($pictures) > 0)
                            @foreach($pictures as $picture)
                            <div class="col-sm-2 float-left">
                                <label for="{{$picture->id}}"><img src="{{asset($picture->image_thumb)}}" width="100%" height="auto"/></label>
                                <input type="checkbox" class="ImageId" name="pictureId" id="{{$picture->id}}" value="{{$picture->id}}">
                            </div>
                            @endforeach
                        @else
                            <h4>No Image Uploaded</h4>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-body">
                    <button class="btn btn-primary" id="showUploadPicture">Upload Pictures</button>
                    <div class="form-group" id="uploadPicture" style="display: none">
                        <h4>Upload Image</h4>
                        <form action="{{url('/admin/image/store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for="images">Select Image</label>
                            <input type="file" name="images[]" id="images" multiple accept="image/*">

                            <button type="submit" class="btn btn-success">Upload Images</button>
                        </form>
                    </div>
                    <hr/>

                    <div class="form-group" style="display: none">
                        <h4>Update</h4>
                        <label for="image_title">Title</label>
                        <input type="text" name="image_title" id="image_title" class="form-control" value="">
                        <label for="image_alt">Alt</label>
                        <input type="text" name="image_alt" id="image_alt" class="form-control" value="">
                        <button class="btn btn-primary">Update</button>
                    </div>

                    <div class="form-group" id="imageInfo" style="display: none">
                        <h4>Image Details</h4>
                        <p>
                            <label for="title">ID: </label>
                            <strong id="ImageId"></strong>
                        </p>
                        <p>
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </p>
                        <p>
                            <label for="image_alt">Alt</label>
                            <input type="text" name="alt" id="alt" class="form-control">
                        </p>
                        <p>
                            <input type="hidden" id="pictureId" value="">
                            <button id="saveImageInfo">Save Info</button>
                            <span id="msgInfo"></span>
                        </p>
                        <p>
                            <label>Image URL:</label>
                            <strong id="imageUrl"></strong>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function (){
            jQuery("#showUploadPicture").click(function () {
                jQuery("#uploadPicture").toggle("slow");
            });
            $('.ImageId').on('change', function(){
                if(this.checked)
                {
                    $('#imageInfo').show();
                    $.ajax({
                        type:'post',
                        url: "{{url('/api/imageDetails')}}",
                        data: {
                            id: $(this).val(),
                        },
                        success:function(data) {
                            $('#ImageId').text(data.id);
                            $('#pictureId').val(data.id);
                            $('#title').val(data.image_title);
                            $('#alt').val(data.image_alt);
                            $('#imageUrl').text(data.image_full);
                        }
                    });
                }
                else{
                    $('#imageInfo').hide();
                }
            });

            $('#saveImageInfo').click(function (){
                $.ajax({
                    type:'post',
                    url: "{{url('/api/updateImageDetails')}}",
                    data: {
                        id: $('#pictureId').val(),
                        title: $('#title').val(),
                        alt: $('#alt').val()
                    },
                    success:function(data) {
                        $('#msg').text(data.message);
                        $('#pictureId').val(data.response.id);
                        $('#title').val(data.response.image_title);
                        $('#alt').val(data.response.image_alt);
                        $('#imageUrl').text(data.image_full);
                    },
                    error:function(data){
                        $('#msg').text(data.message);
                    }
                });
            })
            /*$('#myClik').click(function (){
                var favorite = [];
                $.each($("input[name='pictureId']:checked"), function(){
                    favorite.push($(this).val());
                });
                alert("My favourite sports are: " + favorite.join(", "));
            });*/

        });
    </script>
@endsection
