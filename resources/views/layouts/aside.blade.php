<aside class="aside active" id="aside">
    <button id="aside_toggle" class="aside_toggle">
        <i class="fa-solid fa-bars-staggered"></i>
        <span class="text">dashboard</span>
    </button>
    <div class="list main_list">
        <ul>
            <li>
                {{-- <a href="#" class="unclickable"> --}}
                <a href={{ route('statistics') }}>
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
                <a href={{ route('users') }}>
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
                <a href="/logout">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i><span class="text">log out</span>
                </a>
            </li>

        </ul>
    </div>
</aside>
