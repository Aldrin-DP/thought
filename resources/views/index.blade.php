@extends('layouts.partials.layout')

@section('content')
    <section class="section">
        <div class="post-header">
            <p>Do you have a thought?</p>
            <a class="btn" href="{{ route('posts.create') }}">Add thought</a>
        </div>

        <div class="card-container">
            @if ($posts->isEmpty())
                <p>No posts found matching your search.</p>
            @else
                @foreach ($posts as $post)
                    <div class="card-post">
                        <div class="card-heading">
                            <div class="title">
                                <h3>{{ $post->title }}</h3>
                            </div>
                            <div class="actions">
                                @can('manage-post', $post)
                                    <a href="{{ route('posts.edit', $post->id) }}" class="action-btn edit">Edit</a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="action-btn delete">Delete</button>
                                    </form>
                                @endcan
                                <a href="{{ route('posts.show', $post->id) }}" class="action-btn view">View Full Content</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="body">
                                <p>{{ $post->body }}</p>
                            </div>
                            <div class="author">
                                @php
                                    $isAuthor = $post->user->id === Auth::id();
                                @endphp
                                @if ($isAuthor)
                                    <p style="color: #fdf1c1">{{ $post->user->firstname . ' ' . $post->user->lastname }}</p>
                                @else
                                    <p>{{ $post->user->firstname . ' ' . $post->user->lastname }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="tags">
                                <p class="tag">{{ $post->category->category ?? 'Null' }}</p>
                            </div>
                            <div class="likes">
                                <span class="like-count">{{ $post->likes()->count() }}</span>
                                <form action="{{ route('posts.like', $post->id) }}" method="POST">
                                    @csrf
                                    @if ($post->isLikedBy(Auth::user()))
                                        <button class="btn"><i class="fas fa-thumbs-down"></i></button>
                                    @else
                                        <button class="btn"><i class="fas fa-thumbs-up"></i></button>
                                    @endif
                                </form>
                            </div>
                            <div class="comment">
                                <span class="comment-count">{{ $post->comments->count() }}</span>
                                <a href="" class="">Comments</a>
                            </div>
                            <div class="date">
                                <p>2024-07-07</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <div>
                {{ $posts->links() }}
            </div>
        </div>

    </section>

    <aside class="aside">
        <div class="search filter">
            <form action="{{ route('index') }}" method="GET">
                <input type="text" name="search" placeholder="Search post" class="input" value="{{ request('search') }}">
                <button type="submit" class="btn">Search</button>
            </form>
        </div>

         <div class="category filter">
            <form action="" method="GET">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="sort" value="{{ request('sort') }}">
                <select name="category" id="" class="input">
                    <option value="">Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->category }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn">Search</button>
            </form>
        </div>

        <div class="sort filter">
            <form action="" method="GET">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="category" value="{{ request('category') }}">
                <select name="sort" id="" class="input">
                    <option value="" disabled>Sort by:</option>
                    <option value="likes" {{ request('sort') == 'likes' ? 'selected' : '' }} >Likes</option>
                    <option value="comments" {{ request('sort') == 'comments' ? 'selected' : '' }}>Comments</option>
                </select>
                <button type="submit" class="btn">Sort</button>
            </form>
        </div>

        <div class="filter" style="margin-top: 1rem;">
            <a href="{{ route('index') }}" class="btn">Clear Filter</a>
        </div>

    </aside>
@endsection
