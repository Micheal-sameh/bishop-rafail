@extends('auth.layout')

@section('title', 'نسيت كلمة المرور - مركز البابا شنوده')

@section('content')
    @if (session('status'))
        <div class="alert alert-ok">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="field">
            <label for="email">البريد الإلكتروني</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="actions">
            <button class="btn" type="submit">إرسال رابط إعادة التعيين</button>
            <a class="btn-link btn-light" href="{{ route('login') }}">رجوع لتسجيل الدخول</a>
        </div>
    </form>
@endsection
