<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fidelist - @yield('title')</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');

        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
        }

        h3 {
            font-weight: bold
        }

        .navbar {
            background-color: rgba(21, 0, 255, 0.247);
            width: 100%;
            height: 8vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main {
            height: 92vh;
            display: flex;
        }

        .sidebar {
            width: 230px;
            height: 100%;
            background-color: rgba(236, 62, 255, 0.333);
            display: flex;
            flex-direction: column;
        }

        .sidebar h3 {
            padding-left: 20px;
            font-size: 20px;
        }

        .sidebar .sidebarLinks {
            display: flex;
            flex-direction: column;
            padding-left: 20px;
            gap: 20px;
        }

        .sidebar .sidebarLinks a {
            text-decoration: none;
        }

        .content {
            background-color: rgba(234, 255, 0, 0.364);
            width: calc(100% - 230px);
            height: 100%;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        @if (Auth::guard('admin')->check())
            <h3>Nav Bar - {{ Auth::guard('admin')->user()->fullname }} (admin)</h3>
        @elseif(Auth::guard('staff')->check())
            <h3>Nav Bar - {{ Auth::guard('staff')->user()->fullname }} (staff)</h3>
        @endif


    </nav>

    <div class="main">
        <aside class="sidebar">
            <h3>Dashbord</h3>
            <div class="sidebarLinks">
                <a href={{ route('profile') }}>Pofile</a>
                <a href={{ route('staffs') }}>Staffs</a>

                @if (Auth::guard('admin')->check())
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit">Log Out</button>
                    </form>
                @elseif(Auth::guard('staff')->check())
                    <form action="{{ route('staff.logout') }}" method="POST">
                        @csrf
                        <button type="submit">Log Out</button>
                    </form>
                @endif

            </div>

        </aside>

        <main class="content">
            @yield('content')
        </main>
    </div>

</body>

</html>
