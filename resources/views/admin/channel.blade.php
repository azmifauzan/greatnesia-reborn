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

<table class="table table-striped">
<thead>
    <tr>
      	<th scope="col">Name</th>
      	<th scope="col">Description</th>
      	<th scope="col">Website</th>
      	<th scope="col" width="130"><a class="btn btn-primary btn-info float-right" href="{{ route('channel.create') }}">Add</a></th>
    </tr>
</thead>
<tbody>
	@foreach($channels as $channel)
	<tr>
		<td>{{ $channel->name }}</td>
		<td>{{ Str::limit($channel->description,175) }}</td>
		<td>{{ $channel->website }}</td>
		<td>
			<a class="btn btn-primary btn-sm btn-warning float-left" href="{{ route('channel.edit',['id'=>$channel->id]) }}">edit</a><form action="{{ route('channel.destroy',['id'=>$channel->id]) }}" method="post">
	              @csrf
	              @method('DELETE')
	              <button class="float-right btn btn-secondary btn-sm btn-danger" type="submit">Delete</button>
            </form>
		</td>
	</tr>
	@endforeach
</tbody>
</table>
<div class="float-right">{{ $channels->links() }}</div>

@endsection