<aside class="outer-aside aside" id="aside">
    <div class="list main_list">
        @if (Auth::guard('admin')->check())
            <ul>
                <li>
                    <a href="{{ route('statistics') }}">
                        <i class="fa-solid fa-chart-line"></i><span>statistiques</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('actions') }}"><i class="fa-solid fa-arrow-pointer"></i><span>actions</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa-solid fa-timeline"></i><span>chronologie</span></a>
                </li>
            </ul>

            <ul>
                <li>
                    <a href={{ route('branches') }}>
                        <i class="fa-solid fa-code-branch"></i><span>branches</span>
                    </a>
                </li>
                <li>
                    <a href={{ route('admins') }}><i class="fa-solid fa-user-tie"></i><span>administrateurs</span></a>
                </li>
                <li>
                    <a href={{ route('staffs') }}><i class="fa-solid fa-users"></i><span>personnel</span></a>
                </li>
                <li>
                    <a href={{ route('clients') }}>
                        <i class="fa-solid fa-person"></i>
                        <span>clients</span>
                    </a>
                </li>
            </ul>

            <ul>
                <li>
                    <a href="{{ Route('cards') }}"><i class="fa-regular fa-credit-card"></i><span>cartes</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa-solid fa-ticket"></i><span>récompenses</span></a>
                </li>
                <li>
                    <a href="{{ Route('scanner.show') }}"><i class="fa-solid fa-qrcode"></i><span>scanner</span></a>
                </li>
            </ul>
        @endif
        @if (Auth::guard('staff')->check())
            <ul>
                <li>
                    <a href={{ route('clients') }}>
                        <i class="fa-solid fa-person"></i>
                        <span>clients</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('scanner.show') }}">
                        <i class="fa-solid fa-qrcode"></i>
                        <span>scanner</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('transaction.demande') }}">
                        <i class="fa-solid fa-stopwatch"></i>
                        <span>vos demandes</span>
                    </a>
                </li>
            </ul>
        @endif
    </div>

    <div class="list">
        <ul>
            <li>
                <a href="/logout"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>déconnexion</span></a>
            </li>
        </ul>
    </div>
</aside>
