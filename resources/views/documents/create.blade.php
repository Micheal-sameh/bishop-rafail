@extends('users.layout')

@section('title', 'إضافة مستند - مركز البابا شنوده')
@section('page_title', 'إضافة مستند')

@section('content')
    @php($type = $activeType ?? 'historical')

    <div class="actions" style="margin-bottom: 12px;">
        <a class="btn-link {{ $type === 'historical' ? '' : 'btn-light' }}" href="{{ route('documents.historical.create') }}">إنشاء تاريخية</a>
        <a class="btn-link {{ $type === 'produced' ? '' : 'btn-light' }}" href="{{ route('documents.produced.create') }}">اصدارات المركز</a>
        <a class="btn-link {{ $type === 'artical' ? '' : 'btn-light' }}" href="{{ route('documents.artical.create') }}">إنشاء مقالات</a>
    </div>

    <form method="POST" action="{{ route("documents.{$type}.store") }}" enctype="multipart/form-data">
        @csrf

        <div class="field">
            <label for="title">العنوان</label>
            <input id="title" type="text" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="field">
            <label for="url">رابط (اختياري)</label>
            <input id="url" type="url" name="url" value="{{ old('url') }}" placeholder="https://...">
        </div>

        <div class="field">
            <label for="file">ملف (اختياري)</label>
            <input id="file" type="file" name="file">
            <p class="meta">اختر رابط أو ملف فقط، وليس الاثنين معاً.</p>
        </div>

        <button class="btn" type="submit">حفظ المستند</button>
    </form>
@endsection
