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
      	<th scope="col" width="130"><a class="btn btn-primary btn-info float-right" href="{{ route('program.create') }}">Add</a></th>
    </tr>
</thead>
<tbody>
	@foreach($programs as $program)
	<tr>
		<td>{{ $program->name }}</td>
		<td>{{ Str::limit($program->description,175) }}</td>
		<td>
			<a class="btn btn-primary btn-sm btn-warning float-left" href="{{ route('program.edit',['id'=>$program->id]) }}">edit</a><form action="{{ route('program.destroy',['id'=>$program->id]) }}" method="post">
	              @csrf
	              @method('DELETE')
	              <button class="float-right btn btn-secondary btn-sm btn-danger" type="submit">Delete</button>
            </form>
		</td>
	</tr>
	@endforeach
</tbody>
</table>
<div class="float-right">{{ $programs->links() }}</div>

@endsection