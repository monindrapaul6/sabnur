<div class="col-md-12">
    <form role="form" method="post" action="{{url('admin/productPictures')}}" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$product->id}}">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">

                <div class="form-group">
                    <label for="ram" class="col-sm-3 control-label">Upload Pictures: </label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="upload" name="upload[]" multiple/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="os" class="col-sm-3 control-label">Pictures: </label>
                    <div class="col-sm-8">
                        @foreach($product->productPictures as $picture)
                        <div class="col-sm-3 float-left">
                            <img src="{{asset($picture->image_thumb)}}" width="100%" height="auto">
                            <span style="position: absolute; top: 10px; right: 20px" onclick="picDelFunc({{$picture->id}}, {{$product->id}})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                </svg>
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <script>
                    function picDelFunc(picId, productId){
                        var x = confirm('Are You sure want to delete?');
                        if(x === true){
                            window.location.href="/admin/productPicture/" + picId + "/" + productId + "/delete/";
                        }
                        else{
                            return false;
                        }
                    }
                </script>


                <div class="form-group">
                    <div class="col-sm-4">
                        <input type="submit" class="btn btn-success" value="Save">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
