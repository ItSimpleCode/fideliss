<aside class="aside active" id="aside">
    <button id="aside_toggle" class="aside_toggle">
        <i class="fa-solid fa-bars-staggered"></i>
        <span class="text">dashboard</span>
    </button>
    <div class="list main_list">
        <ul>
            <li>
                <a href={{ route('statistics') }}>
                    <i class="fa-solid fa-chart-line"></i><span class="text">statistiques</span>
                </a>
            </li>
            <li>
                <a href="#"><i class="fa-solid fa-arrow-pointer"></i><span class="text">actions</span></a>
            </li>
            <li>
                <a href="#"><i class="fa-solid fa-timeline"></i><span class="text">chronologie</span></a>
            </li>
        </ul>
        <ul>
            <li>
                <a href={{ route('branches') }}>
                    <i class="fa-solid fa-code-branch"></i><span class="text">branches</span>
                </a>
            </li>
            <li>
                <a href={{ route('admins') }}><i class="fa-solid fa-user-tie"></i><span class="text">administrateurs</span></a>
            </li>

            <li>
                <a href={{ route('staffs') }}><i class="fa-solid fa-users"></i><span class="text">personnel</span></a>
            </li>
            <li>
                <a href={{ route('clients') }}><i class="fa-solid fa-person"></i><span class="text">clients</span></a>
            </li>
        </ul>
        <ul>
            <li>
                <a href="{{ Route('cards') }}"><i class="fa-regular fa-credit-card"></i><span class="text">cartes</span></a>
            </li>
            <li>
                <a href="#"><i class="fa-solid fa-ticket"></i><span class="text">récompenses</span></a>
            </li>
            <li>
                <a href="{{ Route('scanner.show') }}"><i class="fa-solid fa-qrcode"></i><span class="text">scanner</span></a>
            </li>
        </ul>
    </div>
    <div class="list">
        <ul>
            {{-- <li>
                <a><i class="fa-solid fa-gear"></i><span class="text">options</span></a>
            </li>
            <li>
                <a><i class="fa-regular fa-circle-user"></i><span class="text">profil</span></a>
            </li> --}}
            <li>
                <a href="/logout"><i class="fa-solid fa-arrow-right-from-bracket"></i><span class="text">déconnexion</span></a>
            </li>
        </ul>
    </div>
</aside>
