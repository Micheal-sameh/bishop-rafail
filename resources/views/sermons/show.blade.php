@extends('users.layout')

@section('title', 'عرض العظة - مركز البابا شنوده')
@section('page_title', 'عرض العظة')

@section('content')
    @php($media = $sermon->getFirstMedia('sermon_files'))

    <table>
        <tbody>
            <tr>
                <th>المعرف</th>
                <td>{{ $sermon->id }}</td>
            </tr>
            <tr>
                <th>العنوان</th>
                <td>{{ $sermon->title }}</td>
            </tr>
            <tr>
                <th>قائمة العظات</th>
                <td>{{ $sermon->playlist?->title }}</td>
            </tr>
            <tr>
                <th>الرابط</th>
                <td>
                    @if ($sermon->url)
                        <a class="btn-link btn-light" href="{{ $sermon->url }}" target="_blank">فتح الرابط</a>
                    @else
                        <span class="meta">لا يوجد رابط</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>الملف</th>
                <td>
                    @if ($media)
                        <a class="btn-link btn-light" href="{{ $media->getUrl() }}" target="_blank">تحميل الملف</a>
                    @else
                        <span class="meta">لا يوجد ملف مرفوع</span>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <div class="actions" style="margin-top: 14px;">
        <a class="btn-link btn-light" href="{{ route('sermons.edit', $sermon) }}">تحديث</a>
        <a class="btn-link" href="{{ route('sermons.delete', $sermon) }}">حذف</a>
        <a class="btn-link btn-light" href="{{ route('sermons.index') }}">رجوع</a>
    </div>
@endsection
