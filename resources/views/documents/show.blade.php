@extends('users.layout')

@section('title', 'عرض المستند - مركز البابا شنوده')
@section('page_title', 'عرض المستند')

@section('content')
    @php($url = $document->url ?: $document->getFirstMediaUrl('documents'))

    <table>
        <tbody>
            <tr>
                <th>المعرف</th>
                <td>{{ $document->id }}</td>
            </tr>
            <tr>
                <th>العنوان</th>
                <td>{{ $document->title }}</td>
            </tr>
            <tr>
                <th>النوع</th>
                <td>{{ \App\Enums\BooksTypes::getStringValue((int) $document->type) }}</td>
            </tr>
            <tr>
                <th>الرابط/الملف</th>
                <td>
                    @if ($url)
                        <a class="btn-link btn-light" href="{{ $url }}" target="_blank">فتح</a>
                    @else
                        <span class="meta">لا يوجد رابط أو ملف</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>أُضيف بواسطة</th>
                <td>{{ $document->creator?->name ?? '—' }}</td>
            </tr>
        </tbody>
    </table>

    <div class="actions" style="margin-top: 14px;">
        <a class="btn-link btn-light" href="{{ route('documents.edit', $document) }}">تحديث</a>
        <a class="btn-link" href="{{ route('documents.delete', $document) }}">حذف</a>
        <a class="btn-link btn-light" href="{{ route('documents.index') }}">رجوع</a>
    </div>
@endsection
