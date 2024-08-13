<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Nova Login Form</title>
</head>
<body>
    <form action="{{ route('nova.login') }}" method="POST">
        @csrf
        <div>
            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" autofocus required>
            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
            @error('password')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
    <a href="{{ url('login/google') }}" class="btn btn-primary">Sign in with Google</a>
</body>
</html>