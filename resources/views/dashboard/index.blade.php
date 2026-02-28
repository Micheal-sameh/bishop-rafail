@extends('auth.layout')

@section('title', 'لوحة التحكم - مركز البابا شنوده')

@section('content')
    <h1 class="title">مركز البابا شنوده</h1>
    <p class="subtitle">
        أهلاً {{ $user?->name }}، تم تسجيل دخولك بنجاح إلى مركز البابا شنوده.
    </p>

    <div class="alert alert-ok">
        الجلسة نشطة ويمكنك متابعة العمل الآن.
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn" type="submit">تسجيل الخروج</button>
    </form>

    <p class="meta">
        لتسجيل الدخول بحساب آخر، قم بتسجيل الخروج ثم أعد الدخول.
    </p>
@endsection
