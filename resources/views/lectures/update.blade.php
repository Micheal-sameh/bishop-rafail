@extends('users.layout')

@section('title', 'تحديث المحاضرة - مركز البابا شنوده')
@section('page_title', 'تحديث المحاضرة')

@section('content')
    @php($url = $lecture->url ?: $lecture->getFirstMediaUrl('lectures'))

    <form method="POST" action="{{ route('lectures.update', $lecture) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="field">
            <label for="title">العنوان</label>
            <input id="title" type="text" name="title" value="{{ old('title', $lecture->title) }}" required>
        </div>

        <div class="field">
            <label for="subject_id">المادة</label>
            <select id="subject_id" name="subject_id" required>
                <option value="">اختر المادة</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}" @selected((int) old('subject_id', $lecture->subject_id) === (int) $subject->id)>
                        {{ $subject->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="field">
            <label for="url">الرابط (اختياري)</label>
            <input id="url" type="url" name="url" value="{{ old('url', $lecture->url) }}" placeholder="https://...">
        </div>

        <div class="field">
            <label for="media">ملف وسائط جديد (اختياري)</label>
            <input id="media" type="file" name="media" accept="video/*,audio/*">
            <p class="meta">يمكنك إدخال رابط أو رفع ملف صوت/فيديو فقط.</p>
            @if ($url)
                <p class="meta">الرابط الحالي: <a class="btn-link btn-light" href="{{ $url }}" target="_blank">فتح</a></p>
            @endif
        </div>

        <div class="actions">
            <button class="btn" type="submit">حفظ التحديث</button>
            <a class="btn-link btn-light" href="{{ route('lectures.show', $lecture) }}">إلغاء</a>
        </div>
    </form>

    @include('partials.url_or_file_toggle', ['urlId' => 'url', 'fileId' => 'media'])
@endsection
