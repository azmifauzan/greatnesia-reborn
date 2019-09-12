@extends('admin.layoutprogram')

@section('konten')
<form method="post" action="{{ route('program.update',$program->id) }}" class="form" enctype="multipart/form-data">
	{{ csrf_field() }}
  @method('PUT')
	<div class="form-group">
    	<label for="name">Name</label>
    	<input type="text" class="form-control {{ !$errors->has('name') ?: 'is-invalid' }}" name="name" placeholder="Program name" required="true" autofocus="true" value="{{ $program->name }}">
    	<div class="invalid-feedback">{{ $errors->first('name') }}</div>
  	</div>
  	<div class="form-group">
    	<label for="description">Description</label>
    	<textarea class="form-control {{ !$errors->has('description') ?: 'is-invalid' }}" id="description" name="description" rows="3" placeholder="Program description">{{ $program->description }}</textarea>
    	<div class="invalid-feedback">{{ $errors->first('description') }}</div>
  	</div>
    <div class="form-group">
      <label for="ph">Production House</label>
      <input type="text" name="ph" placeholder="Production House" id="ph" class="form-control col-5">
    </div>
    <div class="form-group">
      <label for="year">Production Year</label>
      <input type="text" class="form-control col-2 {{ !$errors->has('year') ?: 'is-invalid' }}" name="year" required="true" placeholder="1900" value="{{ $program->production_year }}">
      <div class="invalid-feedback">{{ $errors->first('year') }}</div>
    </div>
    <div class="form-group">
      <label for="actors">Actors</label>
      <input type="text" class="form-control {{ !$errors->has('actors') ?: 'is-invalid' }}" name="actors" placeholder="Program Actors" id="actors">
      <div class="invalid-feedback">{{ $errors->first('actors') }}</div>
    </div>    
  	<div class="form-group">
    	<label for="website">Website</label>
    	<input type="text" class="form-control {{ !$errors->has('website') ?: 'is-invalid' }}" name="website" placeholder="http://www." value="{{ $program->website }}">
    	<div class="invalid-feedback">{{ $errors->first('website') }}</div>
  	</div>
  	<button type="submit" name="submit" class="btn btn-primary">Update</button><br/><br/>
</form>

<script type="text/javascript">
  var mz = $('#ph').magicSuggest({
    placeholder: 'Production House ...',
    maxSelection: 1,
    cls: 'col-5',
    value: [{{ $program->productionhouse_id }}],
    data: [
    @foreach($phs as $ph)
    { id:{{ $ph->id }} , name: '{{ $ph->name }}' },
    @endforeach
    ],
    renderer: function(data){
        return '<small class="text-primary">' + data.name + '</small>';
    },
    resultAsString: true
  });

  var ms = $('#actors').magicSuggest({
    placeholder: 'Actors ...',
    data: [
    @foreach($actors as $actor)
    { id:{{ $actor->id }} , name: '{{ $actor->name }}' },
    @endforeach
    ],
    valueField: 'name',
    renderer: function(data){
        return '<small class="text-primary">' + data.name + '</small>';
    },
    value:[
    @foreach($program->actor as $actor)
      '{{ $actor->name }}',
    @endforeach
    ],
    resultAsString: true
  });
</script>

@endsection