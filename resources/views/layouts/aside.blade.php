<aside class="outer-aside aside" id="aside">
    <div class="list main_list">
        @if (Auth::guard('admin')->check())
            @php
                $routes = [
                    [
                        [
                            'route' => 'statistics',
                            'text'=> 'statistiques',
                            'icon' => '<svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 22.5H12C7.28595 22.5 4.92893 22.5 3.46447 21.0355C2 19.5711 2 17.214 2 12.5V9.5M2 2.5V5.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M19.0002 7.5L15.8821 11.4264C15.4045 12.0278 15.1657 12.3286 14.8916 12.4751C14.47 12.7005 13.9663 12.7114 13.5354 12.5046C13.2551 12.3701 13.0035 12.0801 12.5002 11.5C11.9968 10.9199 11.7452 10.6299 11.4649 10.4953C11.034 10.2885 10.5303 10.2995 10.1088 10.5248C9.83461 10.6714 9.5958 10.9721 9.11819 11.5735L6 15.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/></svg>'
                        ],
                        [
                            'route' => 'pending_transactions',
                            'text'=> 'en attente',
                            'icon' => '<svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19 15.5C19 19.366 15.866 22.5 12 22.5C8.13401 22.5 5 19.366 5 15.5V9.5C5 5.63401 8.13401 2.5 12 2.5C15.866 2.5 19 5.63401 19 9.5V11.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M10.5 9C10.5 8.17157 11.1716 7.5 12 7.5C12.8284 7.5 13.5 8.17157 13.5 9V11C13.5 11.8284 12.8284 12.5 12 12.5C11.1716 12.5 10.5 11.8284 10.5 11V9Z" class="stroke" stroke-width="1.5"/><path d="M12 2.5V7.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/></svg>'
                        ],
                        [
                            'route' => 'timeLine',
                            'text'=> 'chronologie',
                            'icon' => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 14V12C22 8.22876 22 6.34315 20.8284 5.17157C19.6569 4 17.7712 4 14 4M14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14V12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M7 4V2.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M17 4V2.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/><circle cx="18" cy="18" r="3" class="stroke" stroke-width="1.5"/><path d="M20.5 20.5L22 22" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M21.5 9H16.625H10.75M2 9H5.875" class="stroke" stroke-width="1.5" stroke-linecap="round"/></svg>'
                        ],
                    ],
                    [
                        [
                            'route' => 'admins',
                            'text'=> 'administrateurs',
                            'icon' => '<svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 11.5C13.1046 11.5 14 10.6046 14 9.5C14 8.39543 13.1046 7.5 12 7.5C10.8954 7.5 10 8.39543 10 9.5C10 10.6046 10.8954 11.5 12 11.5Z" class="stroke" stroke-width="1.5"/><path d="M16 15.5C16 16.6046 16 17.5 12 17.5C8 17.5 8 16.6046 8 15.5C8 14.3954 9.79086 13.5 12 13.5C14.2091 13.5 16 14.3954 16 15.5Z" class="stroke" stroke-width="1.5"/><path d="M3 10.9167C3 7.71907 3 6.12028 3.37752 5.58241C3.75503 5.04454 5.25832 4.52996 8.26491 3.50079L8.83772 3.30472C10.405 2.76824 11.1886 2.5 12 2.5C12.8114 2.5 13.595 2.76824 15.1623 3.30472L15.7351 3.50079C18.7417 4.52996 20.245 5.04454 20.6225 5.58241C21 6.12028 21 7.71907 21 10.9167C21 11.3996 21 11.9234 21 12.4914C21 14.9963 20.1632 16.9284 19 18.4041M3.19284 14.5C4.05026 18.7984 7.57641 21.0129 9.89856 22.0273C10.62 22.3424 10.9807 22.5 12 22.5C13.0193 22.5 13.38 22.3424 14.1014 22.0273C14.6796 21.7747 15.3324 21.4478 16 21.0328" class="stroke" stroke-width="1.5" stroke-linecap="round"/></svg>'
                        ],
                        [
                            'route' => 'staffs',
                            'text'=> 'personnel',
                            'icon' => '<svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 10.5C14.2091 10.5 16 8.70914 16 6.5C16 4.29086 14.2091 2.5 12 2.5C9.79086 2.5 8 4.29086 8 6.5C8 8.70914 9.79086 10.5 12 10.5Z" class="stroke" stroke-width="1.5"/><path d="M18 9.5C19.6569 9.5 21 8.38071 21 7C21 5.61929 19.6569 4.5 18 4.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M6 9.5C4.34315 9.5 3 8.38071 3 7C3 5.61929 4.34315 4.5 6 4.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M17.1973 15.5C17.7078 16.0883 18 16.7714 18 17.5C18 19.7091 15.3137 21.5 12 21.5C8.68629 21.5 6 19.7091 6 17.5C6 15.2909 8.68629 13.5 12 13.5C12.3407 13.5 12.6748 13.5189 13 13.5553" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M20 19.5C21.7542 19.1153 23 18.1411 23 17C23 15.8589 21.7542 14.8847 20 14.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M4 19.5C2.24575 19.1153 1 18.1411 1 17C1 15.8589 2.24575 14.8847 4 14.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/></svg>'
                        ],
                        [
                            'route' => 'clients',
                            'text'=> 'clients',
                            'icon' => '<svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 11.5C10.1046 11.5 11 10.6046 11 9.5C11 8.39543 10.1046 7.5 9 7.5C7.89543 7.5 7 8.39543 7 9.5C7 10.6046 7.89543 11.5 9 11.5Z" class="stroke" stroke-width="1.5"/><path d="M13 15.5C13 16.6046 13 17.5 9 17.5C5 17.5 5 16.6046 5 15.5C5 14.3954 6.79086 13.5 9 13.5C11.2091 13.5 13 14.3954 13 15.5Z" class="stroke" stroke-width="1.5"/><path d="M22 12.5C22 16.2712 22 18.1569 20.8284 19.3284C19.6569 20.5 17.7712 20.5 14 20.5H10C6.22876 20.5 4.34315 20.5 3.17157 19.3284C2 18.1569 2 16.2712 2 12.5C2 8.72876 2 6.84315 3.17157 5.67157C4.34315 4.5 6.22876 4.5 10 4.5H14C17.7712 4.5 19.6569 4.5 20.8284 5.67157C21.298 6.14118 21.5794 6.7255 21.748 7.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M19 12.5H15" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M19 9.5H14" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M19 15.5H16" class="stroke" stroke-width="1.5" stroke-linecap="round"/></svg>'
                        ],
                    ],
                    [
                        [
                            'route' => 'agencies',
                            'text'=> 'Agences',
                            'icon' => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.5 7.04148C12.3374 7.0142 12.1704 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13C13.6569 13 15 11.6569 15 10C15 9.82964 14.9858 9.6626 14.9585 9.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M5 15.2161C4.35254 13.5622 4 11.8013 4 10.1433C4 5.64588 7.58172 2 12 2C16.4183 2 20 5.64588 20 10.1433C20 14.6055 17.4467 19.8124 13.4629 21.6744C12.5343 22.1085 11.4657 22.1085 10.5371 21.6744C9.26474 21.0797 8.13831 20.1439 7.19438 19" class="stroke" stroke-width="1.5" stroke-linecap="round"/></svg>'
                        ],
                        [
                            'route' => 'cards',
                            'text'=> 'cardes',
                            'icon' => '<svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 17H6" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M8 14H6" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M14 15.5C14 14.5572 14 14.0858 14.2929 13.7929C14.5858 13.5 15.0572 13.5 16 13.5C16.9428 13.5 17.4142 13.5 17.7071 13.7929C18 14.0858 18 14.5572 18 15.5C18 16.4428 18 16.9142 17.7071 17.2071C17.4142 17.5 16.9428 17.5 16 17.5C15.0572 17.5 14.5858 17.5 14.2929 17.2071C14 16.9142 14 16.4428 14 15.5Z" class="stroke" stroke-width="1.5"/><path d="M22 12.5C22 8.72876 22 6.84315 20.8284 5.67157C19.6569 4.5 17.7712 4.5 14 4.5H10C6.22876 4.5 4.34315 4.5 3.17157 5.67157C2 6.84315 2 8.72876 2 12.5C2 16.2712 2 18.1569 3.17157 19.3284C4.34315 20.5 6.22876 20.5 10 20.5H14C17.7712 20.5 19.6569 20.5 20.8284 19.3284C21.4816 18.6752 21.7706 17.8001 21.8985 16.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M2 10.5H7M22 10.5H11" class="stroke" stroke-width="1.5" stroke-linecap="round"/></svg>'
                        ],
//                        [
//                            'route' => 'scanner',
//                            'text'=> 'scanner',
//                            'icon' => '<svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 22.5C6.22876 22.5 4.34315 22.5 3.17157 21.3284C2 20.1569 2 19.2712 2 15.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M22 15.5C22 19.2712 22 20.1569 20.8284 21.3284C19.6569 22.5 17.7712 22.5 14 22.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M14 2.5C17.7712 2.5 19.6569 2.5 20.8284 3.67157C22 4.84315 22 5.72876 22 9.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M10 2.5C6.22876 2.5 4.34315 2.5 3.17157 3.67157C2 4.84315 2 5.72876 2 9.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M2 12.5H22" class="stroke" stroke-width="1.5" stroke-linecap="round"/></svg>'
//                        ]
                    ],
                ];
            @endphp
        @endif
        @if (Auth::guard('staff')->check())
            @php
                $routes = [
                    [
                        [
                            'route' => 'pending_transactions',
                            'text'=> 'en attente',
                            'icon' => '<svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 11.5C10.1046 11.5 11 10.6046 11 9.5C11 8.39543 10.1046 7.5 9 7.5C7.89543 7.5 7 8.39543 7 9.5C7 10.6046 7.89543 11.5 9 11.5Z" class="stroke" stroke-width="1.5"/><path d="M13 15.5C13 16.6046 13 17.5 9 17.5C5 17.5 5 16.6046 5 15.5C5 14.3954 6.79086 13.5 9 13.5C11.2091 13.5 13 14.3954 13 15.5Z" class="stroke" stroke-width="1.5"/><path d="M22 12.5C22 16.2712 22 18.1569 20.8284 19.3284C19.6569 20.5 17.7712 20.5 14 20.5H10C6.22876 20.5 4.34315 20.5 3.17157 19.3284C2 18.1569 2 16.2712 2 12.5C2 8.72876 2 6.84315 3.17157 5.67157C4.34315 4.5 6.22876 4.5 10 4.5H14C17.7712 4.5 19.6569 4.5 20.8284 5.67157C21.298 6.14118 21.5794 6.7255 21.748 7.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M19 12.5H15" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M19 9.5H14" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M19 15.5H16" class="stroke" stroke-width="1.5" stroke-linecap="round"/></svg>'
                        ],
                                                [
                            'route' => 'clients',
                            'text'=> 'clients',
                            'icon' => '<svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 11.5C10.1046 11.5 11 10.6046 11 9.5C11 8.39543 10.1046 7.5 9 7.5C7.89543 7.5 7 8.39543 7 9.5C7 10.6046 7.89543 11.5 9 11.5Z" class="stroke" stroke-width="1.5"/><path d="M13 15.5C13 16.6046 13 17.5 9 17.5C5 17.5 5 16.6046 5 15.5C5 14.3954 6.79086 13.5 9 13.5C11.2091 13.5 13 14.3954 13 15.5Z" class="stroke" stroke-width="1.5"/><path d="M22 12.5C22 16.2712 22 18.1569 20.8284 19.3284C19.6569 20.5 17.7712 20.5 14 20.5H10C6.22876 20.5 4.34315 20.5 3.17157 19.3284C2 18.1569 2 16.2712 2 12.5C2 8.72876 2 6.84315 3.17157 5.67157C4.34315 4.5 6.22876 4.5 10 4.5H14C17.7712 4.5 19.6569 4.5 20.8284 5.67157C21.298 6.14118 21.5794 6.7255 21.748 7.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M19 12.5H15" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M19 9.5H14" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M19 15.5H16" class="stroke" stroke-width="1.5" stroke-linecap="round"/></svg>'
                        ],
                    ],
//                    [
//                        [
//                            'route' => 'scanner',
//                            'text'=> 'scanner',
//                            'icon' => '<svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 22.5C6.22876 22.5 4.34315 22.5 3.17157 21.3284C2 20.1569 2 19.2712 2 15.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M22 15.5C22 19.2712 22 20.1569 20.8284 21.3284C19.6569 22.5 17.7712 22.5 14 22.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M14 2.5C17.7712 2.5 19.6569 2.5 20.8284 3.67157C22 4.84315 22 5.72876 22 9.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M10 2.5C6.22876 2.5 4.34315 2.5 3.17157 3.67157C2 4.84315 2 5.72876 2 9.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/><path d="M2 12.5H22" class="stroke" stroke-width="1.5" stroke-linecap="round"/></svg>'
//                        ]
//                    ],
                ];
            @endphp
        @endif
        @foreach($routes as $ul)
            <ul>
                @foreach($ul as $li)
                    <li>
                        <a {{Route::currentRouteName() === $li['route'] ? ' class=selected' : '' }} href="{{ Route($li['route']) }}">
                            @php echo $li['icon'] @endphp
                            <span>{{ $li['text'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </div>
    <div class="list">
        <ul>
            <li>
                <a href="/logout">
                    <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8 16.4999C8 19.3283 8 20.7425 8.87868 21.6212C9.51998 22.2625 10.4466 22.4358 12 22.4826M8 8.49994C8 5.67151 8 4.2573 8.87868 3.37862C9.75736 2.49994 11.1716 2.49994 14 2.49994H15C17.8284 2.49994 19.2426 2.49994 20.1213 3.37862C21 4.2573 21 5.67151 21 8.49994V10.4999V14.4999V16.4999C21 19.3283 21 20.7425 20.1213 21.6212C19.3529 22.3896 18.175 22.4861 16 22.4982"
                            class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                        <path
                            d="M3 9.99994V14.9999C3 17.3569 3 18.5354 3.73223 19.2677C4.46447 19.9999 5.64298 19.9999 8 19.9999M3.73223 5.73217C4.46447 4.99994 5.64298 4.99994 8 4.99994"
                            class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M6 12.4999H15M15 12.4999L12.5 14.9999M15 12.4999L12.5 9.99994" class="stroke"
                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>déconnexion</span></a>
            </li>
        </ul>
    </div>
</aside>
