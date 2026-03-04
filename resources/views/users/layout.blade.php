<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'لوحة الإدارة - مركز البابا شنوده')</title>
    <style>
        :root {
            --ink: #30251d;
            --soft-ink: #5f4a39;
            --paper: #f4ecdc;
            --paper-edge: #e7d9be;
            --accent: #7a5132;
            --accent-strong: #5c3a22;
            --ok-bg: #e8f2e4;
            --ok-text: #35572a;
            --danger-bg: #f8e0db;
            --danger-text: #7d2f20;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Georgia", "Times New Roman", serif;
            background: radial-gradient(circle at top, #fff8eb 0, var(--paper) 35%, #eadfca 100%);
            color: var(--ink);
            direction: rtl;
            padding: 24px;
        }

        body.no-scroll {
            overflow: hidden;
        }

        .container {
            width: min(1100px, 100%);
            margin: 0 auto;
            background: linear-gradient(175deg, #fbf5e8 0%, var(--paper) 42%, #efe2cb 100%);
            border: 1px solid var(--paper-edge);
            border-radius: 14px;
            box-shadow: 0 12px 28px rgba(66, 44, 26, 0.2);
            padding: 0;
            overflow: hidden;
        }

        .page {
            display: grid;
            grid-template-columns: 260px 1fr;
            min-height: 640px;
        }

        .sidebar {
            background: #efe3cc;
            border-left: 1px solid #dccaaa;
            padding: 18px;
        }

        .sidebar-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .brand {
            margin: 0 0 16px;
            font-size: 1.1rem;
            color: var(--accent-strong);
        }

        .sidebar-close {
            display: none;
            border: 1px solid #cebfa4;
            background: #fffaf0;
            color: var(--accent-strong);
            border-radius: 8px;
            padding: 5px 10px;
            cursor: pointer;
        }

        .sidebar h3 {
            margin: 16px 0 8px;
            font-size: 0.96rem;
            color: var(--soft-ink);
        }

        .menu {
            display: grid;
            gap: 8px;
        }

        .menu-group {
            margin-bottom: 14px;
        }

        .menu-title {
            margin: 0 0 8px;
            font-size: 0.85rem;
            color: var(--soft-ink);
            opacity: 0.9;
        }

        .menu a {
            display: block;
            padding: 9px 10px;
            border-radius: 8px;
            border: 1px solid #d9c4a1;
            background: #fff6e8;
            color: var(--ink);
            text-decoration: none;
            font-size: 0.93rem;
        }

        .menu a.active {
            background: linear-gradient(180deg, var(--accent) 0%, var(--accent-strong) 100%);
            color: #fff;
            border-color: transparent;
        }

        .content {
            padding: 24px;
            min-width: 0;
        }

        .burger {
            display: none;
            border: 1px solid #cebfa4;
            background: #fffaf0;
            color: var(--accent-strong);
            border-radius: 8px;
            padding: 7px 10px;
            cursor: pointer;
            font-size: 1rem;
            line-height: 1;
        }

        .overlay {
            display: none;
        }

        .top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
        }

        .title { margin: 0; font-size: 1.7rem; }

        .btn, .btn-link {
            display: inline-block;
            border: 0;
            border-radius: 10px;
            background: linear-gradient(180deg, var(--accent) 0%, var(--accent-strong) 100%);
            color: #fff;
            padding: 10px 14px;
            text-decoration: none;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .btn-light {
            background: #fffaf0;
            color: var(--accent-strong);
            border: 1px solid #cebfa4;
        }

        .table-wrap { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fffaf0;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #e2d5bc;
            text-align: right;
            vertical-align: top;
        }

        th { color: var(--soft-ink); background: #f7efdf; }

        .actions { display: flex; gap: 8px; flex-wrap: wrap; }

        .field { margin-bottom: 12px; }

        label { display: block; margin-bottom: 6px; color: var(--soft-ink); }

        input, select {
            width: 100%;
            border: 1px solid #cebfa4;
            border-radius: 10px;
            padding: 10px;
            background: #fffaf0;
            color: var(--ink);
        }

        .alert {
            border-radius: 10px;
            padding: 10px 12px;
            margin-bottom: 12px;
            font-size: 0.92rem;
        }

        .alert-ok { background: var(--ok-bg); color: var(--ok-text); border: 1px solid #cfe2c7; }
        .alert-error { background: var(--danger-bg); color: var(--danger-text); border: 1px solid #efc2b7; }

        .meta { color: var(--soft-ink); }

        .inline-form { display: inline; }

        .pagination {
            margin-top: 14px;
            list-style: none;
            padding: 0;
            display: flex;
            gap: 6px;
            direction: ltr;
        }

        .d-flex { display: flex; }
        .justify-content-center { justify-content: center; }
        .pt-2 { padding-top: 0.5rem; }

        .page-item { display: inline-flex; }

        .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            height: 38px;
            padding: 0 10px;
            border-radius: 10px;
            border: 1px solid #d9c4a1;
            background: #fff6e8;
            color: var(--ink);
            text-decoration: none;
            font-size: 0.93rem;
        }

        .page-item.active .page-link {
            background: linear-gradient(180deg, var(--accent) 0%, var(--accent-strong) 100%);
            color: #fff;
            border-color: transparent;
        }

        .page-item.disabled .page-link {
            opacity: 0.55;
            cursor: not-allowed;
            pointer-events: none;
        }

        @media (max-width: 980px) {
            body {
                padding: 0;
            }

            .container {
                width: 100%;
                border-radius: 0;
                border-left: 0;
                border-right: 0;
            }

            .page {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .sidebar {
                position: fixed;
                top: 0;
                right: 0;
                height: 100vh;
                width: min(300px, 82vw);
                border-left: 1px solid #dccaaa;
                border-bottom: 0;
                z-index: 30;
                transform: translateX(105%);
                transition: transform 0.22s ease;
                overflow-y: auto;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.35);
                z-index: 20;
            }

            .overlay.open {
                display: block;
            }

            .content {
                padding: 16px;
            }

            .burger {
                display: inline-block;
            }

            .sidebar-close {
                display: inline-block;
            }

            .top {
                justify-content: flex-start;
                align-items: center;
                margin-bottom: 12px;
            }

            .title {
                font-size: 1.3rem;
                margin: 0;
            }

            th, td {
                padding: 8px;
                font-size: 0.92rem;
            }

            .actions {
                gap: 6px;
            }

            .btn, .btn-link {
                font-size: 0.9rem;
                padding: 9px 12px;
            }

            .table-wrap {
                -webkit-overflow-scrolling: touch;
            }

            table {
                min-width: 620px;
            }
        }

        @media (max-width: 560px) {
            .content {
                padding: 12px;
            }

            .title {
                font-size: 1.15rem;
            }

            .burger {
                padding: 6px 9px;
            }
        }
    </style>
</head>
<body>
    <main class="container">
        <div id="sidebar-overlay" class="overlay"></div>
        <div class="page">
            <aside id="app-sidebar" class="sidebar">
                <div class="sidebar-head">
                    <h2 class="brand">مركز البابا شنودة للتاريخ الكنسي بكنائس وسط القاهرة</h2>
                    <button id="sidebar-close" class="sidebar-close" type="button" aria-label="إغلاق القائمة">✕</button>
                </div>

                <h3>الأقسام</h3>
                <div class="menu-group">
                    <p class="menu-title">العظات</p>
                    <div class="menu">
                        <a class="{{ request()->routeIs('sermons-playlists.*') ? 'active' : '' }}" href="{{ route('sermons-playlists.index') }}">قوائم العظات</a>
                        <a class="{{ request()->routeIs('sermons.historical.*') ? 'active' : '' }}" href="{{ route('sermons.historical.index') }}">العظات التاريخية</a>
                        <a class="{{ request()->routeIs('sermons.trips.*') ? 'active' : '' }}" href="{{ route('sermons.trips.index') }}">عظات الرحلات</a>
                    </div>
                </div>
                <div class="menu-group">
                    <p class="menu-title">الكتب</p>
                    <div class="menu">
                        <a class="{{ request()->routeIs('documents.historical.*') ? 'active' : '' }}" href="{{ route('documents.historical.index') }}">كتب تاريخية</a>
                        <a class="{{ request()->routeIs('documents.produced.*') ? 'active' : '' }}" href="{{ route('documents.produced.index') }}">كتب اصدارات المركز</a>
                        <a class="{{ request()->routeIs('documents.artical.*') ? 'active' : '' }}" href="{{ route('documents.artical.index') }}">كتب مقالات</a>
                    </div>
                </div>

                <div class="menu-group">
                    <p class="menu-title">الميديا</p>
                    <div class="menu">
                        <a class="{{ request()->routeIs('films.*') ? 'active' : '' }}" href="{{ route('films.index') }}">الأفلام</a>
                        <a class="{{ request()->routeIs('gallery.*') ? 'active' : '' }}" href="{{ route('gallery.index') }}">المعرض</a>
                    </div>
                </div>

                <div class="menu-group">
                    <p class="menu-title">التعليم</p>
                    <div class="menu">
                        <a class="{{ request()->routeIs('subjects.*') ? 'active' : '' }}" href="{{ route('subjects.index') }}">المواد</a>
                        <a class="{{ request()->routeIs('lectures.*') ? 'active' : '' }}" href="{{ route('lectures.index') }}">المحاضرات</a>
                    </div>
                </div>

                <div class="menu-group">
                    <p class="menu-title">إدارة النظام</p>
                    <div class="menu">
                        <a class="{{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">المستخدمون</a>
                        <a class="{{ request()->routeIs('audits.*') ? 'active' : '' }}" href="{{ route('audits.index') }}">سجل العمليات</a>
                    </div>
                </div>

                <h3>عام</h3>
                <div class="menu">
                    {{-- <a href="{{ route('dashboard') }}">لوحة التحكم</a> --}}
                    <a class="{{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">الملف الشخصي</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn" style="width:100%;margin-top:0;" type="submit">تسجيل الخروج</button>
                    </form>
                </div>
            </aside>

            <section class="content">
                <header class="top">
                    <button id="sidebar-toggle" class="burger" type="button" aria-label="فتح القائمة">☰</button>
                    <h1 class="title">@yield('page_title', 'لوحة الإدارة')</h1>
                </header>

                @if (session('status'))
                    <div class="alert alert-ok">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">{{ $errors->first() }}</div>
                @endif

                @yield('content')
            </section>
        </div>
    </main>

    <script>
        (function () {
            var toggleButton = document.getElementById('sidebar-toggle');
            var closeButton = document.getElementById('sidebar-close');
            var sidebar = document.getElementById('app-sidebar');
            var overlay = document.getElementById('sidebar-overlay');

            if (!toggleButton || !sidebar || !overlay) {
                return;
            }

            function toggleSidebar() {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('open');
                document.body.classList.toggle('no-scroll', sidebar.classList.contains('open'));
            }

            function closeSidebar() {
                sidebar.classList.remove('open');
                overlay.classList.remove('open');
                document.body.classList.remove('no-scroll');
            }

            toggleButton.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', closeSidebar);

            if (closeButton) {
                closeButton.addEventListener('click', closeSidebar);
            }

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    closeSidebar();
                }
            });

            sidebar.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', closeSidebar);
            });

            window.addEventListener('resize', function () {
                if (window.innerWidth > 980) {
                    closeSidebar();
                }
            });
        })();
    </script>
</body>
</html>
