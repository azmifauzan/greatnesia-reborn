@extends('layout')

@section('konten')    

@php
$waktu = strtotime(date('H:i:s'))+60*60*7;
@endphp

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Jadwal Acara TV Saat ini:</h1>
</div>

<div class="card-deck text-center">

	@foreach($jadwals as $jadwal)
	<div class="card mb-4 shadow-sm">
      <div class="card-header">
      	<a href=""><img src="{{ $jadwal->logo }}" class="mr-1 rounded" alt="{{ $jadwal->name }}" height="25px"></a>
      </div>
      <div class="card-body">
        <ul class="list-unstyled mt-1 mb-4">
          @foreach($jadwal->schedule as $prog)
          <li><b>{{ substr($prog->start,0,5) }}</b> - {{ $prog->program->name }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-outline-warning">Nonton Sekarang</button>
      </div>
    </div>    
    @endforeach
</div>

@endsection
