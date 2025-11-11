@extends('admin.layouts.partials.app')

@section('title', 'Users')

@section('admin-content')

    <div class="admin-content">
        @include('admin.includes.sidebar')

        <div class="main">

            <h2>Users</h2>

            <div class="search">
                <form action="{{ route('admin.users.index') }}" method="GET">
                    @csrf
                    <input type="text" class="input" name="search" placeholder="Enter name..">
                    <button class="btn">Search</button>
                </form>
            </div>

            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                            <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                            <td> <img src="{{ asset('storage/' . ($user->profile?->image ?? 'default.jpg')) }}"
                                alt="" width="30px" height="30px"></td>
                            <td>{{ $user->firstname . ' ' . $user->lastname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->userType($user->is_admin) }}</td>
                            <td>
                            <div class="action-buttons">
                                {{-- <a href="" class="edit-icon"> <i class="fa fa-edit"></i> </a> --}}
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="delete-icon" style="all:unset; cursor: pointer;"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                            </div>
                            </td>
                        </tr>
                        @empty
                            <td colspan="6">No users found in the database.</td>
                        @endforelse
                    </tbody>
                </table>
                 <div class="pagination">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
