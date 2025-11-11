<div class="sidebar">
    <ul>
        <li class="{{ request()->routeIs('admin.dashboard') ? 'selected' : '' }}">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="{{ request()->routeIs('admin.users.index') ? 'selected' : '' }}">
            <a href="{{ route('admin.users.index') }}">Users</a>
        </li>
        <li class="{{ request()->routeIs('admin.posts.index') ? 'selected' : '' }}">
            <a href="{{ route('admin.posts.index') }}">Posts</a>
        </li>
        <li class="{{ request()->routeIs('admin.categories.index') ? 'selected' : '' }}">
            <a href="{{ route('admin.categories.index') }}">Categories</a>
        </li>
    </ul>
</div>

