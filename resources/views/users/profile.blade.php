@extends('users.layout')

@section('title', 'الملف الشخصي - مركز البابا شنوده')
@section('page_title', 'الملف الشخصي')

@section('content')
    <table>
        <tbody>
            <tr>
                <th>الاسم</th>
                <td>{{ $user?->name }}</td>
            </tr>
            <tr>
                <th>رقم الهاتف</th>
                <td>{{ $user?->phone }}</td>
            </tr>
            <tr>
                <th>البريد الإلكتروني</th>
                <td>{{ $user?->email }}</td>
            </tr>
            <tr>
                <th>الحالة</th>
                <td>{{ (int) ($user?->status ?? 0) === 2 ? 'مُفعّل' : 'غير مُفعّل' }}</td>
            </tr>
        </tbody>
    </table>
@endsection
