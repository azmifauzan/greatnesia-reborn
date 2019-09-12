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
      	<th scope="col">Kategori</th>
      	<th scope="col" width="130"><a class="btn btn-primary btn-info float-right" href="{{ route('category.create') }}">Add</a></th>
    </tr>
</thead>
<tbody>
	@foreach($categories as $category)
	<tr>
		<td>{{ $category->title }}</td>		
		<td>
			<a class="btn btn-primary btn-sm btn-warning float-left" href="{{ route('category.edit',['id'=>$category->id]) }}">edit</a><form action="{{ route('category.destroy',['id'=>$category->id]) }}" method="post">
	              @csrf
	              @method('DELETE')
	              <button class="float-right btn btn-secondary btn-sm btn-danger" type="submit">Delete</button>
            </form>
		</td>
	</tr>
	@endforeach
</tbody>
</table>
<div class="float-right">{{ $categories->links() }}</div>

@endsection