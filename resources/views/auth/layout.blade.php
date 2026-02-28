<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'مركز البابا شنوده')</title>
    <style>
        :root {
            color-scheme: light;
            --ink: #30251d;
            --soft-ink: #5f4a39;
            --paper: #f4ecdc;
            --paper-edge: #e7d9be;
            --accent: #7a5132;
            --accent-strong: #5c3a22;
            --danger-bg: #f8e0db;
            --danger-text: #7d2f20;
            --ok-bg: #e8f2e4;
            --ok-text: #35572a;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Georgia", "Times New Roman", serif;
            background: radial-gradient(circle at top, #fff8eb 0, var(--paper) 35%, #eadfca 100%);
            color: var(--ink);
            display: grid;
            place-items: center;
            padding: 24px;
            direction: rtl;
        }

        .sheet {
            width: min(560px, 100%);
            background: linear-gradient(175deg, #fbf5e8 0%, var(--paper) 42%, #efe2cb 100%);
            border: 1px solid var(--paper-edge);
            border-radius: 14px;
            box-shadow: 0 12px 28px rgba(66, 44, 26, 0.2);
            padding: 30px;
        }

        .title {
            margin: 0;
            font-size: 1.9rem;
            letter-spacing: 0.03em;
        }

        .subtitle {
            margin: 8px 0 24px;
            color: var(--soft-ink);
            line-height: 1.45;
        }

        .field {
            margin-bottom: 14px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.94rem;
            color: var(--soft-ink);
        }

        input {
            width: 100%;
            border: 1px solid #cebfa4;
            border-radius: 10px;
            padding: 11px 12px;
            background: #fffaf0;
            color: var(--ink);
            font-size: 0.96rem;
        }

        input:focus {
            outline: 2px solid #c59e6e;
            border-color: #b88f60;
        }

        .row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 4px;
        }

        .checkbox {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.92rem;
            color: var(--soft-ink);
        }

        .checkbox input {
            width: auto;
        }

        .btn {
            width: 100%;
            border: 0;
            border-radius: 10px;
            background: linear-gradient(180deg, var(--accent) 0%, var(--accent-strong) 100%);
            color: #fff;
            padding: 12px 16px;
            cursor: pointer;
            font-size: 0.98rem;
            letter-spacing: 0.02em;
            margin-top: 14px;
        }

        .btn:hover {
            filter: brightness(1.04);
        }

        .meta {
            margin-top: 18px;
            font-size: 0.92rem;
            color: var(--soft-ink);
            text-align: center;
        }

        .meta a,
        .inline-link {
            color: var(--accent-strong);
            font-weight: 600;
            text-decoration: none;
        }

        .meta a:hover,
        .inline-link:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 10px;
            padding: 10px 12px;
            margin-bottom: 14px;
            font-size: 0.92rem;
        }

        .alert-error {
            background: var(--danger-bg);
            color: var(--danger-text);
            border: 1px solid #efc2b7;
        }

        .alert-ok {
            background: var(--ok-bg);
            color: var(--ok-text);
            border: 1px solid #cfe2c7;
        }
    </style>
</head>
<body>
    <main class="sheet">
        @yield('content')
    </main>
</body>
</html>
