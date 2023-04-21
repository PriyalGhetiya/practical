@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('flash_messages')
            <div class="card">
                <a href="javascript:void(0)" id="create-new-post"  class="btn btn-primary">Add Product</a>
            </div>
            <div class="card">
                <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
            </div>
            <div class="card">
                <a href="{{ route('subCategories.create') }}" class="btn btn-primary">Add SubCategory</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="postCrudModal"></h4>
    </div>
    <div class="modal-body">
        <form id="postForm" name="postForm" action="{{ route('product.store') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            @csrf
           <input type="hidden" name="post_id" id="post_id">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="name" name="name" value="" required="">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-12">
                    <input class="form-control" id="description" name="description" value="" required="">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Price</label>
                <div class="col-sm-12">
                    <input class="form-control" id="price" name="price" value="" required="">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Category</label>
                <div class="col-sm-12">
                    <select class="form-control select2 w-100 select_category" name="category">
                    <option selected value="">Select Category</option>
                        @foreach($categorys AS $category)
                        <option value="{{ $category->id }}"  @if(isset($edit->category_id))  @if($edit->category_id == $category->id) {{ 'selected' }} @endif @else @if(old('category') == $category->id) {{ 'selected' }} @endif @endif>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div  class="form-group">
               <label class="form-label">Product Image</label>
                    <input type="file" name="image" class="form-control"/>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
             <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save
             </button>
            </div>
        </form>
    </div>
    <div class="modal-footer">

    </div>
</div>
</div>
</div>
<script>
  $(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#create-new-post').click(function () {
        $('#btn-save').val("create-post");
        $('#postForm').trigger("reset");
        $('#postCrudModal').html("Add New post");
        $('#ajax-crud-modal').modal('show');
    });
})
</script>
@endsection

