@extends('admin.layoutprogram')

@section('konten')

<form method="post" action="{{ route('jadwal.update',$schedule->id) }}" class="form">
	{{ csrf_field() }}
  @method('PUT')
  <div class="form-group">
    <label for="channel">Channel</label>
    <input type="text" name="channel" id="channel" required="true" placeholder="Channel Name" class="form-control {{ !$errors->has('channel') ?: 'is-invalid' }}">
    <div class="invalid-feedback">{{ $errors->first('channel') }}</div>
  </div>
  <div class="form-group">
    <label for="channel">Day</label>
    <select name="day" class="form-control col-3">
      <option value="1" @if($schedule->day == 1) selected="true" @endif>Senin</option>
      <option value="2" @if($schedule->day == 2) selected="true" @endif>Selasa</option>
      <option value="3" @if($schedule->day == 3) selected="true" @endif>Rabu</option>
      <option value="4" @if($schedule->day == 4) selected="true" @endif>Kamis</option>
      <option value="5" @if($schedule->day == 5) selected="true" @endif>Jumat</option>
      <option value="6" @if($schedule->day == 6) selected="true" @endif>Sabtu</option>
      <option value="7" @if($schedule->day == 7) selected="true" @endif>Minggu</option>
    </select>
    <div class="invalid-feedback">{{ $errors->first('day') }}</div>
  </div>
  <div class="form-row">
  	<div class="form-group col-md-6">
    	<label for="name">Start Time</label>
    	<input type="text" class="form-control {{ !$errors->has('start') ?: 'is-invalid' }}" name="start" placeholder="Start time" required="true" value="{{ $schedule->start }}">
    	<div class="invalid-feedback">{{ $errors->first('start') }}</div>
  	</div>
    <div class="form-group col-md-6">
      <label for="name">End Time</label>
      <input type="text" class="form-control {{ !$errors->has('end') ?: 'is-invalid' }}" name="end" placeholder="End time" required="true" value="{{ $schedule->end }}">
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
  mz.setValue([{{ $schedule->channel_id }}]);

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
  ms.setValue([{{ $schedule->program_id }}]);
</script>

@endsection