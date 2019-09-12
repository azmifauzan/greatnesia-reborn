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
      	<th scope="col">Address</th>
      	<th scope="col" width="130"><a class="btn btn-primary btn-info float-right" href="{{ route('ph.create') }}">Add</a></th>
    </tr>
</thead>
<tbody>
	@foreach($phs as $ph)
	<tr>
		<td>{{ $ph->name }}</td>
		<td>{{ Str::limit($ph->description,150) }}</td>
		<td>{{ Str::limit($ph->address,50) }}</td>
		<td>
			<a class="btn btn-primary btn-sm btn-warning float-left" href="{{ route('ph.edit',['id'=>$ph->id]) }}">edit</a><form action="{{ route('ph.destroy',['id'=>$ph->id]) }}" method="post">
	              @csrf
	              @method('DELETE')
	              <button class="float-right btn btn-secondary btn-sm btn-danger" type="submit">Delete</button>
            </form>
		</td>
	</tr>
	@endforeach
</tbody>
</table>
<div class="float-right">{{ $phs->links() }}</div>

@endsection