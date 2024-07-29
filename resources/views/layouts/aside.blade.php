{{-- <aside id="main_aside" class="main_aside show-list">
    <button id="aside_toggle" class="aside_toggle">
        <i class="fa-solid fa-bars-staggered"></i>
        <span>dashboard</span>
    </button>
    <div class="list">
        <ul>
            <li>
                <a href="#" class="unclickable">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>statistics</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-arrow-pointer"></i>
                    <span>actions</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-timeline"></i>
                    <span>time line</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-users"></i>
                    <span>users</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="list">
        <ul>
            <li>
                <a href="#">
                    <i class="fa-solid fa-gear"></i>
                    <span>options</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa-regular fa-circle-user"></i>
                    <span>profile</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
--}}

<aside class="aside active" id="aside">
    <button id="aside_toggle" class="aside_toggle">
        <i class="fa-solid fa-bars-staggered"></i>
        <span class="text">dashboard</span>
    </button>
    <div class="list main_list">
        <ul>
            <li>
                <a href="#" class="unclickable">
                    <i class="fa-solid fa-chart-line"></i>
                    <span class="text">statistics</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-arrow-pointer"></i>
                    <span class="text">actions</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-timeline"></i>
                    <span class="text">time line</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-users"></i>
                    <span class="text">users</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="list">
        <ul>
            <li>
                <a>
                    <i class="fa-solid fa-gear"></i><span class="text">options</span>
                </a>
            </li>
            <li>
                <a>
                    <i class="fa-regular fa-circle-user"></i><span class="text">profile</span>
                </a>
            </li>
            <li>
                <a>
                    <i class="fa-solid fa-arrow-right-from-bracket"></i><span class="text">log out</span>
                </a>
                {{-- <form
                    action="{{ (Auth::guard('admin')->check() ? route('admin.logout') : Auth::guard('staff')->check()) ? route('staff.logout') : '' }}"
                    method="POST">
                    <form action="{{ route('staff.logout') }}" method="POST">
                        @csrf
                        <button type="submit">Log Out</button>
                    </form> --}}
            </li>

        </ul>
    </div>
</aside>
