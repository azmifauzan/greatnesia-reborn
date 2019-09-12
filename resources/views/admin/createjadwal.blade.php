@extends('admin.layoutprogram')

@section('konten')

<form method="post" action="{{ route('jadwal.store') }}" class="form">
	{{ csrf_field() }}
  <div class="form-group">
    <label for="channel">Channel</label>
    <input type="text" name="channel" id="channel" required="true" placeholder="Channel Name" class="form-control {{ !$errors->has('channel') ?: 'is-invalid' }}">
    <div class="invalid-feedback">{{ $errors->first('channel') }}</div>
  </div>
  <div class="form-group">
    <label for="channel">Day</label>
    <select name="day" class="form-control col-3">
      <option value="1">Senin</option>
      <option value="2">Selasa</option>
      <option value="3">Rabu</option>
      <option value="4">Kamis</option>
      <option value="5">Jumat</option>
      <option value="6">Sabtu</option>
      <option value="7">Minggu</option>
    </select>
    <div class="invalid-feedback">{{ $errors->first('day') }}</div>
  </div>
  <div class="form-row">
  	<div class="form-group col-md-6">
    	<label for="name">Start Time</label>
    	<input type="text" class="form-control {{ !$errors->has('start') ?: 'is-invalid' }}" name="start" placeholder="Start time" required="true" value="{{ old('start') }}">
    	<div class="invalid-feedback">{{ $errors->first('start') }}</div>
  	</div>
    <div class="form-group col-md-6">
      <label for="name">End Time</label>
      <input type="text" class="form-control {{ !$errors->has('end') ?: 'is-invalid' }}" name="end" placeholder="End time" required="true" value="{{ old('end') }}">
      <div class="invalid-feedback">{{ $errors->first('end') }}</div>
    </div>
  </div>
  <div class="form-group">
    <label for="program">Program</label>
    <input type="text" name="program" id="program" required="true" placeholder="Program Name" class="form-control {{ !$errors->has('program') ?: 'is-invalid' }}">
    <div class="invalid-feedback">{{ $errors->first('program') }}</div>
  </div> 
	<button type="submit" name="submit" class="btn btn-primary">Submit</button><br/><br/>
</form>

<script type="text/javascript">
  var mz = $('#channel').magicSuggest({
    placeholder: 'Channel Name ...',
    maxSelection: 1,
    cls: 'col-5',
    data: [
    @foreach($channels as $ch)
    { id:{{ $ch->id }}, name: '{{ $ch->name }}' },
    @endforeach
    ],
    renderer: function(data){
        return '<small class="text-primary">' + data.name + '</small>';
    },
    resultAsString: true
  });
  @if(old('channel') !== null )
  mz.setValue([
    @foreach(old('channel') as $cph)
      '{{ $cph }}',
    @endforeach
    ]);
  @endif

  var ms = $('#program').magicSuggest({
    placeholder: 'Program Name ...',
    maxSelection: 1,
    cls: 'col-8',
    data: [
    @foreach($programs as $pr)
    { id:{{ $pr->id }}, name: '{{ $pr->name }}' },
    @endforeach
    ],
    renderer: function(data){
        return '<small class="text-primary">' + data.name + '</small>';
    },
    resultAsString: true
  });
  @if(old('program') !== null )
  ms.setValue([
    @foreach(old('program') as $pph)
      '{{ $pph }}',
    @endforeach
    ]);
  @endif
</script>

@endsection