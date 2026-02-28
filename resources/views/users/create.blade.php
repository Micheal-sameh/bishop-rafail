@extends('users.layout')

@section('title', 'إضافة مستخدم - مركز البابا شنوده')
@section('page_title', 'إضافة مستخدم جديد')

@section('content')
    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="field">
            <label for="name">الاسم</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="field">
            <label for="phone">رقم الهاتف</label>
            <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required>
        </div>

        <div class="field">
            <label for="email">البريد الإلكتروني</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="field">
            <label for="status">الحالة</label>
            <select id="status" name="status" required>
                <option value="">اختر الحالة</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status['value'] }}" @selected((int) old('status') === (int) $status['value'])>
                        {{ $status['name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <p class="meta">سيتم تعيين كلمة مرور افتراضية تلقائياً عند إنشاء المستخدم.</p>

        <button class="btn" type="submit">حفظ المستخدم</button>
    </form>
@endsection
