<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Add Post</title>
</head>
<body>
    @include('layouts.partials.navbar')

    <div class="register-container">
        <form action="{{ route('posts.store') }}" class="register-form" method="POST">
            @csrf
            <h3>Add Post</h3>

            <div class="form-control">
                <label for="">Title</label>
                <input type="text" class="input" placeholder="Title" name="title" value="{{ old('title') }}">
                <span class="text-error">
                    @error('title')
                    {{ $message }}
                @enderror
                </span>

            </div>

            <div class="form-control">
                <label for="">Body</label>
                <textarea name="body" id="" cols="30" rows="10" class="textarea" placeholder="Description">
                    {{ old('body') }}
                </textarea>
                <span class="text-error">
                    @error('body')
                    {{ $message }}
                @enderror
                </span>
            </div>

            <div class="form-control">
                <label for="">Category</label>
                <select name="category_id" id="">
                    <option value="">Select category:</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : ''}} >
                            {{ $category->category }}
                        </option>
                    @endforeach
                </select>
                <span class="text-error">
                    @error('category')
                    {{ $message }}
                @enderror
                </span>
            </div>

            <div class="form-control">
                <button type="submit" class="btn">Post</button>
            </div>

        </form>
    </div>
</body>
</html>
