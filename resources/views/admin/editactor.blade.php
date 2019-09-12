@extends('admin.layout')

@section('konten')

<form method="post" action="{{ route('actor.update',$actor->id) }}" class="form" enctype="multipart/form-data">
	@method('PUT')
  @csrf
	<div class="form-group">
  	<label for="name">Name</label>
  	<input type="text" class="form-control {{ !$errors->has('name') ?: 'is-invalid' }}" name="name" placeholder="Actor name" required="true" autofocus="true" value="{{ $actor->name }}">
  	<div class="invalid-feedback">{{ $errors->first('name') }}</div>
	</div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="birth_place">Birth Place</label>
      <input type="text" class="form-control {{ !$errors->has('birth_place') ?: 'is-invalid' }}" name="birth_place" placeholder="Birth place" value="{{ $actor->birth_place }}">
      <div class="invalid-feedback">{{ $errors->first('birth_place') }}</div>
    </div>
    <div class="form-group col-md-6">
      <label for="birth_date">Birth Date</label>
      <input type="text" class="form-control {{ !$errors->has('birth_date') ?: 'is-invalid' }}" name="birth_date" placeholder="Birth date" value="{{ $actor->birth_date }}">
      <div class="invalid-feedback">{{ $errors->first('birth_date') }}</div>
    </div>
  </div>
	<div class="form-group">
  	<label for="description">Biodata</label>
  	<textarea class="form-control {{ !$errors->has('biodata') ?: 'is-invalid' }}" id="description" name="biodata" rows="3" placeholder="Biodata">{{ $actor->biodata }}</textarea>
  	<div class="invalid-feedback">{{ $errors->first('biodata') }}</div>
	</div>
	<div class="form-group">
  	<label for="website">Website</label>
  	<input type="text" class="form-control {{ !$errors->has('website') ?: 'is-invalid' }}" name="website" placeholder="http://www." value="{{ $actor->website }}">
  	<div class="invalid-feedback">{{ $errors->first('website') }}</div>
	</div>
	<div class="form-group">
  	<label for="foto">Foto</label>
    @if($actor->foto != "")
      <br/><div class="mw-25"><img src="{{ url($actor->logo) }}" alt="{{ $actor->name }}" class="img-thumbnail mw-25"></div><br/>
      @endif
  	<input type="file" class="form-control-file" id="foto" name="foto">
  	<div class="invalid-feedback">{{ $errors->first('foto') }}</div>
	</div>
	<button type="submit" name="submit" class="btn btn-primary">Update</button><br/><br/>
</form>

@endsection