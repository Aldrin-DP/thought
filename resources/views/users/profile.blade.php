@extends('layouts.partials.layout')

@section('content')
    <div class="profile-container">

        {{-- <div class="profile-section">
            <h3>Profile</h3>
            <form action="">
                <div class="form-control">
                    <label for="">Firstname</label>
                    <input type="text" name="firstname" class="input" value="{{ $user->firstname }}">
                </div>

                <div class="form-control">
                    <label for="">Lastname</label>
                    <input type="text" name="lastname" class="input" value="{{ $user->lastname }}">
                </div>

                <div class="form-control">
                    <label for="">Profile Image</label>
                    <input type="file" name="firstname" class="input">
                </div>

                <div class="form-control">
                    <button type="submit" class="btn">Update</button>
                </div>
            </form>
        </div> --}}

        <div class="profile-image-section">
            <h3>Add Profile Image</h3>
            <div class="profile-image">
                <form action="{{ route('profile.avatar.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-control">
                        <label for="">Profile Image</label>
                        <input type="file" class="input" name="image">
                    </div>

                    <div class="form-control">
                        <button type="submit" class="btn">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
