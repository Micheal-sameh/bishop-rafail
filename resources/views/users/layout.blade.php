<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'إدارة المستخدمين - مركز البابا شنوده')</title>
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

        .container {
            width: min(1100px, 100%);
            margin: 0 auto;
            background: linear-gradient(175deg, #fbf5e8 0%, var(--paper) 42%, #efe2cb 100%);
            border: 1px solid var(--paper-edge);
            border-radius: 14px;
            box-shadow: 0 12px 28px rgba(66, 44, 26, 0.2);
            padding: 24px;
        }

        .top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
        }

        .title { margin: 0; font-size: 1.7rem; }

        .nav {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

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

        .pagination { margin-top: 14px; }
        .pagination nav { direction: ltr; }
    </style>
</head>
<body>
    <main class="container">
        <header class="top">
            <h1 class="title">@yield('page_title', 'إدارة المستخدمين')</h1>
            <nav class="nav">
                <a class="btn-link btn-light" href="{{ route('dashboard') }}">لوحة التحكم</a>
                <a class="btn-link" href="{{ route('users.index') }}">قائمة المستخدمين</a>
                <a class="btn-link" href="{{ route('users.create') }}">إضافة مستخدم</a>
            </nav>
        </header>

        @if (session('status'))
            <div class="alert alert-ok">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif

        @yield('content')
    </main>
</body>
</html>
