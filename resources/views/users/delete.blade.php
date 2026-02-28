@extends('users.layout')

@section('title', 'حذف المستخدم - مركز البابا شنوده')
@section('page_title', 'تأكيد حذف المستخدم')

@section('content')
    <p class="meta">هل أنت متأكد من حذف المستخدم التالي؟</p>

    <table style="margin-top: 12px;">
        <tbody>
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
        </tbody>
    </table>

    <div class="actions" style="margin-top: 14px;">
        <form class="inline-form" method="POST" action="{{ route('users.destroy', $user) }}">
            @csrf
            @method('DELETE')
            <button class="btn" type="submit">تأكيد الحذف</button>
        </form>

        <a class="btn-link btn-light" href="{{ route('users.show', $user) }}">إلغاء</a>
    </div>
@endsection
