@extends('admin.layouts.partials.app')

@section('title', 'Posts')

@section('admin-content')

    <div class="admin-content">
        @include('admin.includes.sidebar')

        <div class="main">

            <h2>Posts</h2>

            <div class="search">
                <form action="{{ route('admin.posts.index') }}" method="GET">
                    @csrf
                    <input type="text" class="input" name="search" placeholder="Enter post..">
                    <button class="btn">Search</button>
                </form>
            </div>

            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Likes</th>
                            <th>Comments</th>
                            <th>Author</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr>
                                <td>{{ ($posts->currentPage() - 1) * $posts->perPage() + $loop->iteration }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->likes->count() }}</td>
                                <td>{{ $post->comments->count() }}</td>
                                <td>{{ $post->user->firstname }}</td>
                                <td>
                                    <div class="action-buttons">
                                    {{-- <a href="" class="edit-icon"> <i class="fa fa-edit"></i> </a> --}}
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="delete-icon" style="all:unset; cursor: pointer;"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                                </td>
                            </tr>
                        @empty
                            <td colspan="6">No posts found in the database.</td>
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
