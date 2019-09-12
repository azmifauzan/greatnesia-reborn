@extends('admin.layout')

@section('konten')

<form method="post" action="{{ route('channel.update',$channel->id) }}" class="form" enctype="multipart/form-data">
	@method('PUT')
  @csrf
	<div class="form-group">
    	<label for="name">Name</label>
    	<input type="text" class="form-control {{ !$errors->has('name') ?: 'is-invalid' }}" name="name" placeholder="Channel name" required="true" autofocus="true" value="{{ $channel->name }}">
    	<div class="invalid-feedback">{{ $errors->first('name') }}</div>
  	</div>
  	<div class="form-group">
    	<label for="description">Description</label>
    	<textarea class="form-control {{ !$errors->has('description') ?: 'is-invalid' }}" id="description" name="description" rows="3" placeholder="Channel description">{{ $channel->description }}</textarea>
    	<div class="invalid-feedback">{{ $errors->first('description') }}</div>
  	</div>
  	<div class="form-group">
    	<label for="website">Website</label>
    	<input type="text" class="form-control {{ !$errors->has('website') ?: 'is-invalid' }}" name="website" placeholder="http://www." value="{{ $channel->website }}">
    	<div class="invalid-feedback">{{ $errors->first('website') }}</div>
  	</div>
  	<div class="form-group">
    	<label for="logo">Logo</label>
    	@if($channel->logo != "")
	  	<br/><div class="mw-25"><img src="{{ url($channel->logo) }}" alt="{{ $channel->name }}" class="img-thumbnail mw-25"></div><br/>
	  	@endif
    	<input type="file" class="form-control-file" id="logo" name="logo">
    	<div class="invalid-feedback">{{ $errors->first('logo') }}</div>
  	</div>
  	<button type="submit" name="submit" class="btn btn-primary">Update</button><br/><br/>
</form>

@endsection