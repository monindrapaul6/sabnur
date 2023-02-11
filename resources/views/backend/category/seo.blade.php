<div class="col-md-12">
    <form role="form" method="post" action="{{url('admin/categorySEOupdate')}}" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$category->id}}">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">

                <div class="form-group">
                    <label for="meta_title" class="col-sm-3 control-label">meta_title: </label>
                    <div class="col-sm-9">
                        <textarea name="meta_title" id="meta_title" class="form-control" cols="30">@isset($category->categorySeo->meta_title){{$category->categorySeo->meta_title}}@endisset</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="meta_description" class="col-sm-3 control-label">meta_description: </label>
                    <div class="col-sm-9">
                        <textarea name="meta_description" id="meta_description" class="form-control" cols="30">@isset($category->categorySeo->meta_description){{$category->categorySeo->meta_description}}@endisset</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="meta_keyword" class="col-sm-3 control-label">meta_keyword: </label>
                    <div class="col-sm-9">
                        <textarea name="meta_keyword" id="meta_keyword" class="form-control" cols="30">@isset($category->categorySeo->meta_keyword){{$category->categorySeo->meta_keyword}}@endisset</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="og_title" class="col-sm-3 control-label">og_title: </label>
                    <div class="col-sm-9">
                        <textarea name="og_title" id="og_title" class="form-control" cols="30">@isset($category->categorySeo->og_title){{$category->categorySeo->og_title}}@endisset</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="og_description" class="col-sm-3 control-label">og_description: </label>
                    <div class="col-sm-9">
                        <textarea name="og_description" id="og_description" class="form-control" cols="30">@isset($category->categorySeo->og_description){{$category->categorySeo->og_description}}@endisset</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="og_image" class="col-sm-3 control-label">og_image: </label>
                    <div class="col-sm-9">
                        @isset($category->categorySeo->og_image)<img src="{{asset($category->categorySeo->og_image)}}" width="120px" height="120px">@endisset
                    </div>
                </div>
                <div class="form-group">
                    <label for="upload" class="col-sm-3 control-label">Upload Image: </label>
                    <div class="col-sm-9">
                        <input type="file" name="upload" id="upload" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-4">
                        <input type="submit" class="btn btn-success" value="Save">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
