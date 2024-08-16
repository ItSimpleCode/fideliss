<nav class="outer-nav main_nav">
    <div class="logo">
        <img src="{{ asset('img/logo.png') }}" alt="">
    </div>
    <div class="options">
        @yield('add-options')
        <div class="user">
            <button class="user-pic">
                <img src={{ asset('img/user.png') }} alt="photo de profil" class="user_pic">
            </button>
            <span class="user_info">
                @if (Auth::guard('admin')->check())
                    <span>admin</span>
                    <span>{{ Auth::guard('admin')->user()->gender == 'male' ? 'mr.' : 'mme.' }}{{ Auth::guard('admin')->user()->first_name }}
                        {{ Auth::guard('admin')->user()->last_name }}</span>
                @elseif(Auth::guard('staff')->check())
                    <span>staff</span>
                    <span>{{ Auth::guard('staff')->user()->gender == 'male' ? 'mr.' : 'mme.' }}{{ Auth::guard('staff')->user()->first_name }}
                        {{ Auth::guard('staff')->user()->last_name }}</span>
                @endif
            </span>
            <div class="sub-list">
                <ul>
                    <li>
                        <button class="square-btn">
                            <i class="fa-regular fa-lightbulb"></i>
                            <span class="text">mode</span>
                        </button>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="/logout">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span class="text">déconnexion</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>
{{-- @yield('search') --}}
