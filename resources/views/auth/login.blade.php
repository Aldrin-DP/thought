<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Login</title>
</head>

<body>
    @include('layouts.partials.navbar')

    <div class="login-container">
        <form action="{{ route('login.store') }}" class="login-form" method="POST">
            @if (session('error'))
                <p>{{ session('error') }}</p>
            @endif
            @if (session('commentError'))
                <p>{{ session('commentError') }}</p>
            @endif
            <br>
            @csrf
            <h3>Log in</h3>

            <div class="form-control">
                <label for="">Email</label>
                <input type="email" name="email" placeholder="Email" class="input">
                @error('email')
                    <span class="text-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control">
                <label for="">Password</label>
                <input type="password" name="password" placeholder="Password" class="input">
                @error('password')
                    <span class="text-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control">
                <button type="submit" class="btn">Log in</button>
            </div>

            <p>No account yet? <a href="{{ route('auth.register') }}">Register here</a></p>
        </form>
    </div>
</body>

</html>
