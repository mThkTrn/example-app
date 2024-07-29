@include("posts.head")
<body>
  @include("posts.navbar")
  <div class="container mt-5">
    <div class="row">
      @foreach ($posts as $post)
        <div class="col-sm mb-4">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">{{ $post->title }}</h5>
              <small class="text-muted">Posted by: {{ $post->user->name ?? 'Unknown User' }}</small>
            </div>
            <div class="card-body">
              <p class="card-text">{{ $post->body }}</p>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-sm">
                  @if(Auth::id() == $post->user_id)
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                  @endif
                </div>
                <div class="col-sm">
                  @if(Auth::id() == $post->user_id)
                    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</body>
</html>