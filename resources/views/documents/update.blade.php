@extends('users.layout')

@section('title', 'تحديث المستند - مركز البابا شنوده')
@section('page_title', 'تحديث المستند')

@section('content')
    @php($currentUrl = $document->url ?: $document->getFirstMediaUrl('documents'))

    <form method="POST" action="{{ route('documents.update', $document) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" name="type" value="{{ $document->type }}">

        <div class="field">
            <label for="title">العنوان</label>
            <input id="title" type="text" name="title" value="{{ old('title', $document->title) }}" required>
        </div>

        <div class="field">
            <label>النوع</label>
            <input type="text" value="{{ \App\Enums\BooksTypes::getStringValue((int) $document->type) }}" readonly disabled>
        </div>

        <div class="field">
            <label for="url">رابط (اختياري)</label>
            <input id="url" type="url" name="url" value="{{ old('url', $document->url) }}" placeholder="https://...">
        </div>

        <div class="field">
            <label for="file">ملف جديد (اختياري)</label>
            <input id="file" type="file" name="file">
            @if ($currentUrl)
                <p class="meta">الملف/الرابط الحالي: <a href="{{ $currentUrl }}" target="_blank">فتح</a></p>
            @endif
        </div>

        <div class="actions">
            <button class="btn" type="submit">حفظ التحديث</button>
            <a class="btn-link btn-light" href="{{ route('documents.show', $document) }}">إلغاء</a>
        </div>
    </form>

    @include('partials.url_or_file_toggle', ['urlId' => 'url', 'fileId' => 'file'])
@endsection
