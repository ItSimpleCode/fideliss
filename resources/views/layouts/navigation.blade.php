<header>
    <button class="outer-nav aside-toggle">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4 7L7 7M20 7L11 7" class="stroke" stroke-width="1.5" stroke-linecap="round"/>
            <path d="M20 17H17M4 17L13 17" class="stroke" stroke-width="1.5" stroke-linecap="round"/>
            <path d="M4 12H7L20 12" class="stroke" stroke-width="1.5" stroke-linecap="round"/>
        </svg>

    </button>
    <nav class="outer-nav nav">
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
                    @foreach (['admin', 'staff'] as $guard)
                        @if (Auth::guard($guard)->check())
                            <span>{{$guard}}</span>
                            <span>
                                {{ Auth::guard($guard)->user()->gender == 'male' ? 'mr' : (Auth::guard($guard)->user()->gender == 'female' ? 'mme' : '') }}.{{ Auth::guard($guard)->user()->first_name }}
                                {{ Auth::guard($guard)->user()->last_name }}
                            </span>
                            @break
                        @endif
                    @endforeach
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
</header>

{{-- @yield('search') --}}
