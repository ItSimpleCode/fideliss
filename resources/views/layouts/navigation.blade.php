<nav class="main_nav">
    <div class="user">
        <img src={{ asset('img/no-user.jpg') }} alt="photo de profil" class="user_pic">
        <span class="user_name">
            <span class="gender">
                @if (Auth::guard('admin')->check())
                    <span>{{ Auth::guard('admin')->user()->gender == 'male' ? 'mr.' : 'mme.' }}</span>
                    <span>{{ Auth::guard('admin')->user()->first_name }}
                        {{ Auth::guard('admin')->user()->last_name }}</span>
                @elseif(Auth::guard('staff')->check())
                    <span>{{ Auth::guard('staff')->user()->gender == 'male' ? 'mr.' : 'mme.' }}</span>
                    <span>{{ Auth::guard('staff')->user()->first_name }}
                        {{ Auth::guard('staff')->user()->last_name }}</span>
                @endif
            </span>
        </span>
        {{ session('theme') }}
    </div>
    @yield('search')
    <div class="nav-options">
        @yield('date')
        {{-- <button class="square-btn"><span>99</span><i class="fa-regular fa-bell"></i></button> --}}
        {{-- <button class="square-btn"><span>99</span><i class="fa-regular fa-message"></i></button> --}}
        @if (session('theme') == 'dark')
            <a href={{ route('changeTheme', ['theme' => 'light']) }} class="square-btn">
                <i class="fa-regular fa-lightbulb"></i>
            </a>
        @else
            <a href={{ route('changeTheme', ['theme' => 'dark']) }} class="square-btn">
                <i class="fa-solid fa-moon"></i>
            </a>
        @endif

    </div>
</nav>
