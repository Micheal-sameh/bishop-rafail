@extends('users.layout')

@section('title', 'الملف الشخصي - مركز البابا شنوده')
@section('page_title', 'الملف الشخصي')

@section('content')
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <div class="field">
            <label for="name">الاسم</label>
            <input id="name" type="text" name="name" value="{{ old('name', $user?->name) }}" required>
        </div>

        <div class="field">
            <label for="phone">رقم الهاتف (غير قابل للتعديل)</label>
            <input id="phone" type="text" value="{{ $user?->phone }}" readonly disabled>
        </div>

        <div class="field">
            <label for="email">البريد الإلكتروني (غير قابل للتعديل)</label>
            <input id="email" type="email" value="{{ $user?->email }}" readonly disabled>
        </div>

        <div class="field">
            <label for="password">كلمة المرور الجديدة (اختياري)</label>
            <input id="password" type="password" name="password">
        </div>

        <div class="field">
            <label for="password_confirmation">تأكيد كلمة المرور الجديدة</label>
            <input id="password_confirmation" type="password" name="password_confirmation">
        </div>

        <div class="actions">
            <button class="btn" type="submit">حفظ التحديث</button>
        </div>
    </form>
@endsection
