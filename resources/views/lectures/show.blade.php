@extends('users.layout')

@section('title', 'عرض المحاضرة - مركز البابا شنوده')
@section('page_title', 'عرض المحاضرة')

@section('content')
    @php($url = $lecture->url ?: $lecture->getFirstMediaUrl('lectures'))

    <table>
        <tbody>
            <tr>
                <th>المعرف</th>
                <td>{{ $lecture->id }}</td>
            </tr>
            <tr>
                <th>العنوان</th>
                <td>{{ $lecture->title }}</td>
            </tr>
            <tr>
                <th>المادة</th>
                <td>{{ $lecture->subject?->title }}</td>
            </tr>
            <tr>
                <th>الرابط / الوسائط</th>
                <td>
                    @if ($url)
                        <a class="btn-link btn-light" href="{{ $url }}" target="_blank">فتح</a>
                    @else
                        <span class="meta">لا يوجد رابط أو ملف.</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>أُضيف بواسطة</th>
                <td>{{ $lecture->creator?->name ?? '—' }}</td>
            </tr>
        </tbody>
    </table>

    <div class="actions" style="margin-top: 14px;">
        <a class="btn-link btn-light" href="{{ route('lectures.edit', $lecture) }}">تحديث</a>
        <a class="btn-link" href="{{ route('lectures.delete', $lecture) }}">حذف</a>
        <a class="btn-link btn-light" href="{{ route('lectures.index') }}">رجوع</a>
    </div>
@endsection
