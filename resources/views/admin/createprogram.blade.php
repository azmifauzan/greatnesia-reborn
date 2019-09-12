@extends('admin.layoutprogram')

@section('konten')
<form method="post" action="{{ route('program.store') }}" class="form" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="form-group">
    	<label for="name">Name</label>
    	<input type="text" class="form-control {{ !$errors->has('name') ?: 'is-invalid' }}" name="name" placeholder="Program name" required="true" autofocus="true" value="{{ old('name') }}">
    	<div class="invalid-feedback">{{ $errors->first('name') }}</div>
  	</div>
  	<div class="form-group">
    	<label for="description">Description</label>
    	<textarea class="form-control {{ !$errors->has('description') ?: 'is-invalid' }}" id="description" name="description" rows="3" placeholder="Program description">{{ old('description') }}</textarea>
    	<div class="invalid-feedback">{{ $errors->first('description') }}</div>
  	</div>
    <div class="form-group">
      <label for="ph">Production House</label>
      <input type="text" name="ph" placeholder="Production House" id="ph" class="form-control col-5">
    </div>
    <div class="form-group">
      <label for="year">Production Year</label>
      <input type="text" class="form-control col-2 {{ !$errors->has('year') ?: 'is-invalid' }}" name="year" placeholder="1900" value="{{ old('year') }}">
      <div class="invalid-feedback">{{ $errors->first('year') }}</div>
    </div>
    <div class="form-group">
      <label for="actors">Actors</label>
      <input type="text" class="form-control {{ !$errors->has('actors') ?: 'is-invalid' }}" name="actors" placeholder="Program Actors" id="actors">
      <div class="invalid-feedback">{{ $errors->first('actors') }}</div>
    </div>    
  	<div class="form-group">
    	<label for="website">Website</label>
    	<input type="text" class="form-control {{ !$errors->has('website') ?: 'is-invalid' }}" name="website" placeholder="http://www." value="{{ old('website') }}">
    	<div class="invalid-feedback">{{ $errors->first('website') }}</div>
  	</div>
  	<button type="submit" name="submit" class="btn btn-primary">Submit</button><br/><br/>
</form>

<script type="text/javascript">
  var mz = $('#ph').magicSuggest({
    placeholder: 'Production House ...',
    maxSelection: 1,
    cls: 'col-5',
    data: [
    @foreach($phs as $ph)
    { name: '{{ $ph->name }}' },
    @endforeach
    ],
    valueField: 'name',
    renderer: function(data){
        return '<small class="text-primary">' + data.name + '</small>';
    },
    resultAsString: true
  });
  @if(old('ph') !== null )
  mz.setValue([
    @foreach(old('ph') as $pph)
      '{{ $pph }}',
    @endforeach
    ]);
  @endif

  var ms = $('#actors').magicSuggest({
    placeholder: 'Actors ...',
    data: [
    @foreach($actors as $actor)
    { name: '{{ $actor->name }}' },
    @endforeach
    ],
    valueField: 'name',
    renderer: function(data){
        return '<small class="text-primary">' + data.name + '</small>';
    },
    resultAsString: true
  });
  @if(old('actors') !== null )
  ms.setValue([
    @foreach(old('actors') as $act)
      '{{ $act }}',
    @endforeach
    ]);
  @endif
</script>

@endsection