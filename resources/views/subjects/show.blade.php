@extends('users.layout')

@section('title', 'عرض المادة - مركز البابا شنوده')
@section('page_title', 'عرض المادة')

@section('content')
    <table>
        <tbody>
            <tr>
                <th>المعرف</th>
                <td>{{ $subject->id }}</td>
            </tr>
            <tr>
                <th>العنوان</th>
                <td>{{ $subject->title }}</td>
            </tr>
            <tr>
                <th>السنة</th>
                <td>{{ $subject->year }}</td>
            </tr>
        </tbody>
    </table>

    <div class="actions" style="margin-top: 14px;">
        <a class="btn-link btn-light" href="{{ route('subjects.edit', $subject) }}">تحديث</a>
        <a class="btn-link" href="{{ route('subjects.delete', $subject) }}">حذف</a>
        <a class="btn-link btn-light" href="{{ route('subjects.index') }}">رجوع</a>
    </div>
@endsection
