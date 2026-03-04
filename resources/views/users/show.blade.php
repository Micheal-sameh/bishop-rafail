@extends('users.layout')

@section('title', 'عرض المستخدم - مركز البابا شنوده')
@section('page_title', 'بيانات المستخدم')

@section('content')
    <table>
        <tbody>
            <tr>
                <th>المعرف</th>
                <td>{{ $user->id }}</td>
            </tr>
            <tr>
                <th>الاسم</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>رقم الهاتف</th>
                <td>{{ $user->phone }}</td>
            </tr>
            <tr>
                <th>البريد الإلكتروني</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>الحالة</th>
                <td>{{ (int) $user->status === 2 ? 'مُفعّل' : 'غير مُفعّل' }}</td>
            </tr>
            <tr>
                <th>أُضيف بواسطة</th>
                <td>{{ $user->creator?->name ?? '—' }}</td>
            </tr>
        </tbody>
    </table>

    <div class="actions" style="margin-top: 14px;">
        <a class="btn-link btn-light" href="{{ route('users.edit', $user) }}">تحديث</a>
        <form method="POST" action="{{ route('users.reset-password', $user) }}">
            @csrf
            <button class="btn-link" type="submit">إعادة تعيين كلمة المرور</button>
        </form>
        <a class="btn-link" href="{{ route('users.delete', $user) }}">حذف</a>
        <a class="btn-link btn-light" href="{{ route('users.index') }}">رجوع</a>
    </div>
@endsection
