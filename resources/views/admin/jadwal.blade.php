@extends('admin.layout')

@section('konten')

@if (session('success'))
  <div class="alert alert-info alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    	<span aria-hidden="true">&times;</span>
  	</button>
  </div>
@endif
<div class="row">
	<div class="col-7"></div>
	<div class="col">
	<form action="{{ route('jadwal.filter') }}" method="post" class="form-inline">
	  	@csrf
	  	<div class="form-group">
	  	<label for="channel">Channel:&nbsp;</label>
	  	<select name="filter" class="form-control">
	  		<option value="0">All Channels</option>
	  		@foreach($channels as $jd)
	  		<option value="{{ $jd->id }}" @if(isset($cid) && $cid == $jd->id) selected="true" @endif>{{ $jd->name }}</option>
	  		@endforeach
	  	</select>
	  	</div>
	  	&nbsp;<button class="btn btn-success" type="submit">Filter</button>
    </form>
	</div>
	<div class="col-lg-1">
		<a class="btn btn-primary btn-info" href="{{ route('jadwal.create') }}">Add</a>
	</div>
</div><br/>
<table class="table table-striped">

@foreach($jadwals as $jadwal)
<thead>
<tr>
  	<th scope="col" colspan="5"><h4>{{ $jadwal->name }}</h4></th>
</tr>
<tr>
	<th scope="col">Day</th>
	<th scope="col">Start</th>
	<th scope="col">End</th>
	<th scope="col">Program</th>
	<th scope="col" width="130">&nbsp;</th>
</tr>
</thead>
<tbody>
@foreach($jadwal->schedule as $jam)
	@php
		switch($jam->day){
			case "1": $hari="Senin";
				break;
			case "2": $hari="Selasa";
				break;
			case "3": $hari="Rabu";
				break;
			case "4": $hari="Kamis";
				break;
			case "5": $hari="Jumat";
				break;
			case "6": $hari="Sabtu";
				break;
			case "7": $hari="Minggu";
				break;
		}
	@endphp
	<tr>
		<td>{{ $hari }}</td>
		<td>{{ $jam->start }}</td>
		<td>{{ $jam->end }}</td>
		<td>{{ $jam->program->name }}</td>
		<td>
			<a class="btn btn-primary btn-sm btn-warning float-left" href="{{ route('jadwal.edit',['id'=>$jam->id]) }}">edit</a>
			<form action="{{ route('jadwal.destroy',['id'=>$jam->id]) }}" method="post">
	              @csrf
	              @method('DELETE')
	              <button class="float-right btn btn-secondary btn-sm btn-danger" type="submit">Delete</button>
            </form>
        </td>
	</tr>
@endforeach()
<tr><td colspan="5">&nbsp;</td></tr>
@endforeach

</tbody>
</table>
<div class="float-right">{{ $jadwals->links() }}</div>

@endsection