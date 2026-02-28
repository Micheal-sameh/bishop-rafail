@extends('users.layout')

@section('title', 'تحديث المستخدم - مركز البابا شنوده')
@section('page_title', 'تحديث بيانات المستخدم')

@section('content')
    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="field">
            <label for="name">الاسم</label>
            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="field">
            <label for="phone">رقم الهاتف</label>
            <input id="phone" type="text" name="phone" value="{{ old('phone', $user->phone) }}" required>
        </div>

        <div class="field">
            <label for="email">البريد الإلكتروني</label>
            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="field">
            <label for="status">الحالة</label>
            <select id="status" name="status" required>
                @foreach ($statuses as $status)
                    <option value="{{ $status['value'] }}" @selected((int) old('status', $user->status) === (int) $status['value'])>
                        {{ $status['name'] }}
                    </option>
                @endforeach
            </select>
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
            <a class="btn-link btn-light" href="{{ route('users.show', $user) }}">إلغاء</a>
        </div>
    </form>
@endsection
