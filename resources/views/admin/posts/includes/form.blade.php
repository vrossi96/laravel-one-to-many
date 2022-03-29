@if ($post->exists)
   <form class="row" action="{{ route('admin.posts.update', $post->id) }}" method="POST">
      @method('PUT')
   @else
      <form class="row" action="{{ route('admin.posts.store') }}" method="POST">
@endif
@csrf
{{-- FORM NAME POST --}}
<div class="form-group col-md-10">
   <label for="title">Title</label>
   <input name="title" type="text" class="form-control" id="title" placeholder="Enter title"
      value="{{ old('title', $post->title) }}">
   <small class="form-text text-muted">Post title</small>
</div>
{{-- FORM CATEGORY --}}
<div class="form-group col-md-2">
   <label for="category">Category</label>
   <select name="category_id" id="category">
      <option value="null">Select a category</option>
      @foreach ($categories as $category)
         <option @if (old('category_id', $post->category_id) == $category->id) selected @endif value="{{ $category->id }}">
            {{ $category->name }}
         </option>
      @endforeach
   </select>
</div>
{{-- FORM CONTENT --}}
<div class="form-group col-md-12">
   <label for="content">Content</label>
   <textarea class="w-100" name="content" id="content" rows="9">{{ old('content', $post->content) }}</textarea>
</div>
{{-- FORM IMAGE --}}
<div class="form-group col-md-12">
   <label for="img">Image</label>
   <input class="w-100" type="text" name="img" id="img" value="{{ old('img', $post->img) }}">
</div>
{{-- <div class="form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Check me out</label>
   </div> --}}
<div class="col-md-12">
   <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check"></i></button>
</div>
</form>
