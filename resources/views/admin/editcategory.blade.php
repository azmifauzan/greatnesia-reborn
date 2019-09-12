@extends('admin.layout')

@section('konten')

<form method="post" action="{{ route('category.update',$category->id) }}" class="form">
	@method('PUT')
  	@csrf
	<div class="form-group">
  	<label for="name">Title</label>
  	<input type="text" class="form-control {{ !$errors->has('title') ?: 'is-invalid' }}" name="title" placeholder="Category Title" required="true" autofocus="true" value="{{ $category->title }}">
  	<div class="invalid-feedback">{{ $errors->first('title') }}</div>
	</div>  
	<button type="submit" name="submit" class="btn btn-primary">Update</button><br/><br/>
</form>

@endsection