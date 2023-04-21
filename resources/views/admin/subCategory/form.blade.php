<div class="col-md-6">
    <div class="form-group">
        <label class="form-label">Category</label>
        <select class="form-control select2 w-100 @error('category') is-invalid @enderror" name="category" required autofocus>
            <option disabled selected>Select category</option>
            @foreach($categorys AS $category)
            <option value="{{ $category->id }}"
                @if(isset($edit->category_id))
                @if($edit->category_id == $category->id) {{ 'selected' }}
                @endif @else @endif> {{ $category->name }}
            </option>
            @endforeach
        </select>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label class="form-label">Name</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ (isset($edit->name)) ? $edit->name : old('name') }}" required autocomplete="name" autofocus placeholder="Name">

        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>


<div class="col-md-12 text-center">
    <button type="submit" class="btn btn-success mt-1 mb-1">
        {{ (isset($edit)) ? 'Update' : 'Submit' }}
    </button>
</div>
