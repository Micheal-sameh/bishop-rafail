@extends('users.layout')

@section('title', 'عرض الفيلم - مركز البابا شنوده')
@section('page_title', 'عرض الفيلم')

@section('content')
    <table>
        <tbody>
            <tr>
                <th>المعرف</th>
                <td>{{ $film->id }}</td>
            </tr>
            <tr>
                <th>العنوان</th>
                <td>{{ $film->title }}</td>
            </tr>
            <tr>
                <th>الرابط</th>
                <td><a class="btn-link btn-light" href="{{ $film->url }}" target="_blank">فتح</a></td>
            </tr>
        </tbody>
    </table>

    <div class="actions" style="margin-top: 14px;">
        <a class="btn-link btn-light" href="{{ route('films.edit', $film) }}">تحديث</a>
        <a class="btn-link" href="{{ route('films.delete', $film) }}">حذف</a>
        <a class="btn-link btn-light" href="{{ route('films.index') }}">رجوع</a>
    </div>
@endsection
