@extends('auth.layout')

@section('title', 'تسجيل الدخول - مركز البابا شنوده')

@section('content')
    {{-- <h1 class="title">مركز البابا شنوده</h1>
    <p class="subtitle">تسجيل الدخول إلى النظام الداخلي لمركز البابا شنوده.</p> --}}

    @if (session('status'))
        <div class="alert alert-ok">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <div class="login-brand">
        <img src="{{ asset('storage/default.jpg') }}"
            alt="شعار المركز"
            class="login-logo">
        <p class="login-brand-text">مركز البابا شنودة للتاريخ الكنسي بكنائس وسط القاهرة</p>
        </div>

        <div class="field">
            <label for="login">البريد الإلكتروني أو رقم الهاتف</label>
            <input id="login" type="text" name="login" value="{{ old('login') }}" required autofocus>
        </div>

        <div class="field">
            <label for="password">كلمة المرور</label>
            <input id="password" type="password" name="password" required>
        </div>

        <div class="row">
            <label class="checkbox" for="remember">
                <input id="remember" type="checkbox" name="remember" value="1">
                تذكرني
            </label>

            <a class="btn-link" href="{{ route('password.forgot') }}">نسيت كلمة المرور؟</a>
        </div>

        <button class="btn" type="submit">دخول المركز</button>
    </form>
@endsection
