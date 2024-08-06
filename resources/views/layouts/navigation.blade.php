<nav class="main_nav">
    <div class="user">
        <img src={{asset('img/no-user.jpg')}}
            alt="user_pic" class="user_pic">
        <span class="user_name">
            <span class="gender">
                {{ Auth::guard('admin')->check() && Auth::guard('admin')->user()->gender == 'male'
                    ? 'Mr'
                    : (Auth::guard('staff')->check() && Auth::guard('staff')->user()->gender == 'male'
                        ? 'Mr'
                        : 'Ms') }}</span>
            .
            <span>
                {{ Auth::guard('admin')->check()
                    ? Auth::guard('admin')->user()->first_name . ' ' . Auth::guard('admin')->user()->last_name
                    : (Auth::guard('staff')->check()
                        ? Auth::guard('staff')->user()->first_name
                        : '') }}
            </span>
        </span>

    </div>
    <div class="search">
        <i class="fa-solid fa-magnifying-glass"></i>
        <span class="bar"></span>
        <input type="text" name="" id="" placeholder="search">
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
