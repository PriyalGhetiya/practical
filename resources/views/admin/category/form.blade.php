<div class="form-group row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label">Name</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ (isset($edit->name)) ? $edit->name : old('name') }}" autocomplete="name" autofocus placeholder="Name">

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>
<div class="col-md-12 text-center">
    <button type="submit" class="btn btn-success mt-1 mb-1">
        {{ (isset($edit)) ? 'Update' : 'Submit' }}
    </button>
</div>
