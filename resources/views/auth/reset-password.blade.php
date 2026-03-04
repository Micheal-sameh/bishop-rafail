@extends('auth.layout')

@section('title', 'إعادة تعيين كلمة المرور - مركز البابا شنوده')

@section('content')
    @if ($errors->any())
        <div class="alert alert-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="field">
            <label for="email">البريد الإلكتروني</label>
            <input id="email" type="email" name="email" value="{{ old('email', $email) }}" required autofocus>
        </div>

        <div class="field">
            <label for="password">كلمة المرور الجديدة</label>
            <input id="password" type="password" name="password" required>
        </div>

        <div class="field">
            <label for="password_confirmation">تأكيد كلمة المرور</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
        </div>

        <div class="actions">
            <button class="btn" type="submit">حفظ كلمة المرور</button>
            <a class="btn-link btn-light" href="{{ route('login') }}">رجوع لتسجيل الدخول</a>
        </div>
    </form>
@endsection
