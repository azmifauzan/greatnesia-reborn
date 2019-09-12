@extends('admin.layout')

@section('konten')

<form method="post" action="{{ route('category.store') }}" class="form">
	{{ csrf_field() }}
	<div class="form-group">
  	<label for="name">Title</label>
  	<input type="text" class="form-control {{ !$errors->has('title') ?: 'is-invalid' }}" name="title" placeholder="Category Title" required="true" autofocus="true" value="{{ old('title') }}">
  	<div class="invalid-feedback">{{ $errors->first('title') }}</div>
	</div>  
	<button type="submit" name="submit" class="btn btn-primary">Submit</button><br/><br/>
</form>

@endsection