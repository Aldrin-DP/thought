<header class="header">
    <nav class="nav">
        <div class="nav-left">
            <h2><a href="{{ route('index') }}">thought</a></h2>
            <img src="{{ asset('images/logo.png') }}">
        </div>

        @auth
            @if (!Auth::user()->is_admin)
                <div class="nav-center">
                    <ul>
                        <li><a href="{{ route('posts.mine') }}">My Thought</a></li>
                    </ul>
                </div>
            @endif
        @endauth

        <div class="nav-right">
            <div class="nav-right-account">
            @auth
                <img src="{{ asset('storage/' . (Auth::user()->profile->image ?? 'default.jpg')) }}"
                 alt="" width="40px" height="40px" style="border-radius: 40px;">
                <a href="{{ route('profile.show') }}">
                    {{ Auth::user()->firstname .' '. Auth::user()->lastname }}
                </a> |
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn">Logout</button>
                </form>
            @endauth
            </div>
            @guest
                <a href="{{ route('login') }}">Log in</a>
            @endguest
        </div>
    </nav>
</header>
