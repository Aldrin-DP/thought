@extends('layouts.partials.layout')

@section('content')
    <section class="section">
        <div class="post-header">
            <p>Do you have a thought?</p>
            <a class="btn" href="{{ route('posts.create') }}">Add thought</a>
        </div>

        <div class="card-container">
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
                    </div>
                </div>

                <div class="card-body">
                    <div class="body">
                        <p>{{ $post->body }}</p>
                    </div>
                    <div class="author">
                        @php
                            $isAuthor = $post->users_id === Auth::id();
                        @endphp
                        @if ($isAuthor)
                            <p>{{ $post->user->firstname . ' ' . $post->user->lastname }}</p>
                        @else
                            <p>{{ $post->user->firstname . ' ' . $post->user->lastname }}</p>
                        @endif

                    </div>
                </div>

                <div class="card-footer">
                    <div class="likes">
                        @auth
                            <span class="like-count">{{ $post->likes()->count() }}</span>
                            <form action="{{ route('posts.like', $post->id) }}" method="POST">
                                @csrf
                                @if ($post->isLikedBy(Auth::user()))
                                    <button class="btn"><i class="fas fa-thumbs-down"></i></button>
                                @else
                                    <button class="btn"><i class="fas fa-thumbs-up"></i></button>
                                @endif
                            </form>
                        @endauth
                    </div>

                    <div class="comment">
                        @auth
                            <span class="comment-count">{{ $comments->count() }}</span>
                            <a href="" class="">Comments</a>
                        @endauth
                    </div>

                    <div class="date">
                        <p>2024-07-07</p>
                    </div>
                </div>

                <div class="card-comment">
                    <div class="add-comment">
                        <form action="{{ route('comments.store', $post->id) }}" method="POST">
                            @csrf
                            <textarea name="comment" id="" rows="2" placeholder="Enter your comment.." class="textarea"></textarea>
                            <div class="comment-button">
                                <button class="btn">Add Comment</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="comments">
                    <h4>Comments</h4>
                    @if ($comments->count())
                        @forelse ($comments as $comment)
                            <div class="comment-box">
                                <div class="comment-header">
                                    <div class="comment-author">
                                        <img src="{{ asset('storage/' . ($comment->user->profile?->image ?? 'default.jpg')) }}"
                                            alt="" width="40px" height="40px">
                                        <p>{{ $comment->user['firstname'] . ' ' . $comment->user['lastname'] }}</p>
                                    </div>
                                    <div class="comment-actions">
                                        @if (Auth::id() === $comment->user_id)
                                            <a href="" class="edit-icon"> <i class="fa fa-edit"></i> </a>
                                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="delete-icon" style="all:unset; cursor: pointer;"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                        @elseif (Auth::id() === $post->user_id)
                                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="delete-icon" style="all:unset; cursor: pointer;"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <div class="comment-body">
                                    <p>{{ $comment->comment }}</p>
                                </div>
                                <div class="comment-date">
                                    <p>{{ $comment->created_at }}</p>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    @else
                        <p>0 Comments</p>
                    @endif
                </div>
            </div>
        </div>

    </section>

    <aside class="aside">
        <div class="search filter">
            <form action="" method="POST">
                <input type="text" name="search" placeholder="Search post" class="input">
                <button type="submit" class="btn">Search</button>
            </form>
        </div>

        <div class="sort filter">
            <form action="" method="POST">
                <select name="" id="" class="input">
                    <option value="">Sort by:</option>
                    <option value="">Newest</option>
                    <option value="">Likes</option>
                </select>
                <button type="submit" class="btn">Sort</button>
            </form>
        </div>
    </aside>
@endsection
