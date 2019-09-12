@extends('admin.layout')

@section('konten')

<form method="post" action="{{ route('channel.store') }}" class="form" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="form-group">
    	<label for="name">Name</label>
    	<input type="text" class="form-control {{ !$errors->has('name') ?: 'is-invalid' }}" name="name" placeholder="Channel name" required="true" autofocus="true" value="{{ old('name') }}">
    	<div class="invalid-feedback">{{ $errors->first('name') }}</div>
  	</div>
  	<div class="form-group">
    	<label for="description">Description</label>
    	<textarea class="form-control {{ !$errors->has('description') ?: 'is-invalid' }}" id="description" name="description" rows="3" placeholder="Channel description">{{ old('description') }}</textarea>
    	<div class="invalid-feedback">{{ $errors->first('description') }}</div>
  	</div>
  	<div class="form-group">
    	<label for="website">Website</label>
    	<input type="text" class="form-control {{ !$errors->has('website') ?: 'is-invalid' }}" name="website" placeholder="http://www." value="{{ old('website') }}">
    	<div class="invalid-feedback">{{ $errors->first('website') }}</div>
  	</div>
  	<div class="form-group">
    	<label for="logo">Logo</label>
    	<input type="file" class="form-control-file" id="logo" name="logo">
    	<div class="invalid-feedback">{{ $errors->first('logo') }}</div>
  	</div>
  	<button type="submit" name="submit" class="btn btn-primary">Submit</button><br/><br/>
</form>

@endsection