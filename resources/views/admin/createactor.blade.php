@extends('admin.layout')

@section('konten')

<form method="post" action="{{ route('actor.store') }}" class="form" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="form-group">
  	<label for="name">Name</label>
  	<input type="text" class="form-control {{ !$errors->has('name') ?: 'is-invalid' }}" name="name" placeholder="Actor name" required="true" autofocus="true" value="{{ old('name') }}">
  	<div class="invalid-feedback">{{ $errors->first('name') }}</div>
	</div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="birth_place">Birth Place</label>
      <input type="text" class="form-control {{ !$errors->has('birth_place') ?: 'is-invalid' }}" name="birth_place" placeholder="Birth place" value="{{ old('birth_place') }}">
      <div class="invalid-feedback">{{ $errors->first('birth_place') }}</div>
    </div>
    <div class="form-group col-md-6">
      <label for="birth_date">Birth Date</label>
      <input type="text" class="form-control {{ !$errors->has('birth_date') ?: 'is-invalid' }}" name="birth_date" placeholder="Birth date"  value="{{ old('birth_date') }}">
      <div class="invalid-feedback">{{ $errors->first('birth_date') }}</div>
    </div>
  </div>
	<div class="form-group">
  	<label for="description">Biodata</label>
  	<textarea class="form-control {{ !$errors->has('biodata') ?: 'is-invalid' }}" id="description" name="biodata" rows="3" placeholder="Biodata">{{ old('biodata') }}</textarea>
  	<div class="invalid-feedback">{{ $errors->first('biodata') }}</div>
	</div>
	<div class="form-group">
  	<label for="website">Website</label>
  	<input type="text" class="form-control {{ !$errors->has('website') ?: 'is-invalid' }}" name="website" placeholder="http://www." value="{{ old('website') }}">
  	<div class="invalid-feedback">{{ $errors->first('website') }}</div>
	</div>
	<div class="form-group">
  	<label for="logo">Foto</label>
  	<input type="file" class="form-control-file" id="foto" name="foto">
  	<div class="invalid-feedback">{{ $errors->first('foto') }}</div>
	</div>
	<button type="submit" name="submit" class="btn btn-primary">Submit</button><br/><br/>
</form>

@endsection