<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container-fluid">
      <a class="navbar-brand h1" href={{ route('posts.index') }}>Postnet</a>
      <a class="navbar-brand h1" href={{ route('login') }}>Login</a>
      <a class="navbar-brand h1" href={{ route('register') }}>Register</a>
      <a class="navbar-brand h1" href={{ route('dashboard') }}>Dashboard</a>
      <div class="justify-end ">
        <div class="col ">
          <a class="btn btn-sm btn-success" href={{ route('posts.create') }}>Add Post</a>
        </div>
      </div>
    </div>
  </nav>