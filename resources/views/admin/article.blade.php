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
      	<th scope="col">Title</th>
      	<th scope="col">Category</th>
      	<th scope="col">Content</th>
      	<th scope="col">Creator</th>
      	<th scope="col">Placement</th>
      	<th scope="col" width="130"><a class="btn btn-primary btn-info float-right" href="{{ route('article.create') }}">Add</a></th>
    </tr>
</thead>
<tbody>
	@foreach($articles as $article)
	<tr>
		<td>{{ $article->title }}</td>
		<td>{{ $article->category->title }}</td>
		<td>{{ Str::limit($article->content,200)}}</td>
		<td>{{ $article->user->name }}</td>
		@if($article->placement == 1)
		<td>greatnesia.id</td>
		@else
		<td>greatnesia.com</td>
		@endif
		<td>
			<a class="btn btn-primary btn-sm btn-warning float-left" href="{{ route('article.edit',['id'=>$article->id]) }}">edit</a><form action="{{ route('article.destroy',['id'=>$article->id]) }}" method="post">
	              @csrf
	              @method('DELETE')
	              <button class="float-right btn btn-secondary btn-sm btn-danger" type="submit">Delete</button>
            </form>
		</td>
	</tr>
	@endforeach
</tbody>
</table>
<div class="float-right">{{ $articles->links() }}</div>

@endsection