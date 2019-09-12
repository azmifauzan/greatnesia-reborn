@extends('admin.layout')

@section('konten')

<form method="post" action="{{ route('article.update',$article->id) }}" class="form">
	{{ csrf_field() }}
  @method('PUT')
	<div class="form-group">
  	<label for="name">Title</label>
  	<input type="text" class="form-control {{ !$errors->has('title') ?: 'is-invalid' }}" name="title" placeholder="Article Title" required="true" autofocus="true" value="{{ $article->title }}">
  	<div class="invalid-feedback">{{ $errors->first('name') }}</div>
	</div>
  <div class="form-group">
    <label for="category">Category</label>
    <input type="text" name="category" placeholder="Category ..." id="category" class="form-control col-3">
  </div>
   <div class="form-group">
    <label for="creator">Creator</label>
    <input type="text" name="user" placeholder="Creator ..." id="creator" class="form-control col-5">
  </div>
  <div class="form-group">
    <label for="content">Content</label>
    <textarea class="form-control {{ !$errors->has('content') ?: 'is-invalid' }}" id="content" name="content" rows="7" placeholder="Content">{{ $article->content }}</textarea>
    <div class="invalid-feedback">{{ $errors->first('content') }}</div>
  </div>
  <div class="form-group">
    <label for="placement">Placement</label>
    <select name="placement" class="form-control col-3">
      <option value="1" @if($article->placement == 1) {{ 'selected' }} @endif>greatnesia.id</option>
      <option value="2" @if($article->placement == 2) {{ 'selected' }} @endif>greatnesia.com</option>
    </select>
  </div>
	<button type="submit" name="submit" class="btn btn-primary">Update</button><br/><br/>
</form>

<script type="text/javascript">
  var mz = $('#category').magicSuggest({
    placeholder: 'Category ...',
    maxSelection: 1,
    cls: 'col-3',
    value: ['{{ $article->category->title }}'],
    data: [
    @foreach($categories as $category)
    { id:{{ $category->id }} , name: '{{ $category->title }}' },
    @endforeach
    ],
    valueField: 'name',
    renderer: function(data){
        return '<small class="text-primary">' + data.name + '</small>';
    },
    resultAsString: true
  });
  @if(old('category') !== null )
  mz.setValue([
    @foreach(old('category') as $cat)
      '{{ $cat }}',
    @endforeach
    ]);
  @endif

  var ms = $('#creator').magicSuggest({
    placeholder: 'Creator ...',
    maxSelection: 1,
    cls: 'col-5',
    value: ['{{ $article->user->name }}#{{ $article->user->email }}'],
    data: [
    @foreach($users as $user)
    { id:{{ $user->id }} , name: '{{ $user->name }}#{{ $user->email }}' },
    @endforeach
    ],
    valueField: 'name',
    renderer: function(data){
        return '<small class="text-primary">' + data.name + '</small>';
    },
    resultAsString: true
  });
  @if(old('category') !== null )
  ms.setValue([
    @foreach(old('category') as $cat)
      '{{ $cat }}',
    @endforeach
    ]);
  @endif
</script>

@endsection