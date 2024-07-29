@include("posts.head")
<body>
  @include("posts.navbar")

  <div class="container h-100 mt-5">
    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-10 col-md-8 col-lg-6">
        <h3>Update Post</h3>
        @if(Auth::id() == $post->user_id)
          <p>Editing post as: {{ Auth::user()->name }}</p>
          <form action="{{ route('posts.update', $post->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title"
                value="{{ old('title', $post->title) }}" required>
            </div>
            <div class="form-group">
              <label for="body">Body</label>
              <textarea class="form-control" id="body" name="body" rows="3" required>{{ old('body', $post->body) }}</textarea>
            </div>
            <button type="submit" class="btn mt-3 btn-primary">Update Post</button>
          </form>
        @else
          <p class="text-danger">You do not have permission to edit this post.</p>
        @endif
      </div>
    </div>
  </div>

</body>
</html>