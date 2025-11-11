@extends('admin.layouts.partials.app')

@section('title', 'Categories')

@section('admin-content')

    <div class="admin-content">
        @include('admin.includes.sidebar')

        <div class="main">

            <h2>Categories</h2>

            <div class="add-categories-container">
                <h3>Add Category</h3>
                <form action="{{ route('admin.categories.store') }}" class="add-category" method="POST">
                    @csrf
                    <input type="text" class="input" placeholder="Category.." name="category">
                    <button type="submit" class="btn">Add Category</button>
                </form>
            </div>

            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->category }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>{{ $category->updated_at }}</td>
                                <td>
                                    <div class="action-buttons">
                                        {{-- <a href="" class="edit-icon"> <i class="fa fa-edit"></i> </a> --}}
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="delete-icon" style="all:unset; cursor: pointer;"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <td colspan="5">No categories found.</td>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
