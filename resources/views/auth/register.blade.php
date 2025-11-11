<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Register</title>
</head>
<body>
    @include('layouts.partials.navbar')

    <div class="register-container">
        <form action="{{ route('users.store') }}" class="register-form" method="POST">
            @csrf
            <h3>Register</h3>

            <div class="form-control">
                <label for="">Firstname</label>
                <input type="text" class="input" placeholder="Firstname" name="firstname" value="{{ old('firstname') }}">
                <span class="text-error">
                    @error('firstname')
                    {{ $message }}
                @enderror
                </span>

            </div>

            <div class="form-control">
                <label for="">Lastname</label>
                <input type="text" class="input" placeholder="Lastname" name="lastname" value="{{ old('lastname') }}">
                <span class="text-error">
                    @error('lastname')
                    {{ $message }}
                @enderror
                </span>
            </div>

            <div class="form-control">
                <label for="">Gender</label>
                <select name="gender" id="" class="input">
                    <option value="">Select gender:</option>
                    <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender') === 'other' ? 'selected' : '' }}>Other</option>
                </select>
                <span class="text-error">
                    @error('gender')
                    {{ $message }}
                @enderror
                </span>
            </div>

            <div class="form-control">
                <label for="">Email</label>
                <input type="email" name="email" placeholder="Email" class="input" value="{{ old('email') }}">
                <span class="text-error">
                    @error('email')
                    {{ $message }}
                @enderror
                </span>
            </div>

            <div class="form-control">
                <label for="">Password</label>
                <input type="password" name="password" placeholder="Password" class="input">
                <span class="text-error">
                    @error('password')
                    {{ $message }}
                @enderror
                </span>
            </div>

            <div class="form-control">
                <button type="submit" class="btn">Register</button>
            </div>

            <p>Already have an acccount? <a href="{{ route('login') }}">Login here</a></p>
        </form>
    </div>
</body>
</html>
