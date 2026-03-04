@extends('users.layout')

@section('title', 'عرض قائمة العظات - مركز البابا شنوده')
@section('page_title', 'عرض قائمة العظات')

@section('content')
    <table>
        <tbody>
            <tr>
                <th>المعرف</th>
                <td>{{ $playlist->id }}</td>
            </tr>
            <tr>
                <th>العنوان</th>
                <td>{{ $playlist->title }}</td>
            </tr>
            <tr>
                <th>النوع</th>
                <td>{{ $typeLabel((int) $playlist->type) }}</td>
            </tr>
            <tr>
                <th>أُضيف بواسطة</th>
                <td>{{ $playlist->creator?->name ?? '—' }}</td>
            </tr>
        </tbody>
    </table>

    <div class="actions" style="margin-top: 14px;">
        <a class="btn-link btn-light" href="{{ route('sermons-playlists.edit', $playlist) }}">تحديث</a>
        <a class="btn-link" href="{{ route('sermons-playlists.delete', $playlist) }}">حذف</a>
        <a class="btn-link btn-light" href="{{ route('sermons-playlists.index') }}">رجوع</a>
    </div>
@endsection
