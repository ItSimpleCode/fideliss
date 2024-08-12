<nav class="main_nav">
    <div class="user">
        <img src={{ asset('img/no-user.jpg') }} alt="photo de profil" class="user_pic">
        <span class="user_name">
            <span class="gender">
                @if (Auth::guard('admin')->check())
                    <span>{{ Auth::guard('admin')->user()->gender == 'male' ? 'mr.' : 'mme.' }}</span>
                    <span>{{ Auth::guard('admin')->user()->first_name }} {{ Auth::guard('admin')->user()->last_name }}</span>
                @elseif(Auth::guard('staff')->check())
                    <span>{{ Auth::guard('staff')->user()->gender == 'male' ? 'mr.' : 'mme.' }}</span>
                    <span>{{ Auth::guard('staff')->user()->first_name }} {{ Auth::guard('staff')->user()->last_name }}</span>
                @endif
            </span>
        </span>
    </div>
    <div class="search">
        <i class="fa-solid fa-magnifying-glass"></i>
        <span class="bar"></span>
        <input type="text" id="nav-searcher" placeholder="chercher">
    </div>
    <div class="nav-options">
        <button class="date">
            <i class="fa-regular fa-calendar"></i>
            <span class="range">26/06/2024 - 26/07/2024 <i class="fa-solid fa-angle-down"></i></span>
        </button>
        <button class="square-btn"><span>99</span><i class="fa-regular fa-bell"></i></button>
        {{-- <button class="square-btn"><span>99</span><i class="fa-regular fa-message"></i></button> --}}
        <button class="square-btn"><i class="fa-regular fa-lightbulb"></i></button>
    </div>
</nav>
