<div class="col-md-12">
    <form role="form" method="post" action="{{url('admin/category/update')}}" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$category->id}}">

        <div class="form-group">
            <label for="parent_id" class="col-sm-3 control-label">Parent Category: </label>
            <div class="col-sm-5">
                <select class="form-control" id="parent_id" name="parent_id">
                    <option value="0" @if($category->parent_id == 0) selected @endif>This is Parent Category</option>
                    @foreach($parentCategories as $parentCategory)
                        <option value="{{$parentCategory->id}}" @if($category->parent_id == $parentCategory->id) selected @endif>{{$parentCategory->category_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="category_name" class="col-sm-3 control-label">Category Name: </label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="category_name" name="category_name" value="{{$category->category_name}}">
            </div>
        </div>

        <div class="form-group">
            <label for="category_image_thumb" class="col-sm-3 control-label">Category Image: </label>
            <div class="col-sm-5">
                <img src="{{asset($category->category_image_thumb)}}" width="75" height="75">
            </div>
        </div>

        <div class="form-group">
            <label for="upload" class="col-sm-3 control-label">Change Category Image: </label>
            <div class="col-sm-5">
                <input type="file" id="upload" name="upload" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="status" class="col-sm-3 control-label">Status: </label>
            <div class="col-sm-2">
                <select name="status" id="status" class="form-control">
                    <option value="1" @if($category->status == true) selected @endif>ACTIVE</option>
                    <option value="0" @if($category->status == false) selected @endif>INACTIVE</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-5">
                <input type="submit" class="btn btn-success" value="Save">
            </div>
        </div>
    </form>

</div>
