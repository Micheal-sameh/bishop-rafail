@extends('users.layout')

@section('title', 'إضافة محاضرة - مركز البابا شنوده')
@section('page_title', 'إضافة محاضرة')

@section('content')
    <form method="POST" action="{{ route('lectures.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="field">
            <label for="title">العنوان</label>
            <input id="title" type="text" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="field">
            <label for="subject_id">المادة</label>
            <select id="subject_id" name="subject_id" required>
                <option value="">اختر المادة</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}" @selected((int) old('subject_id') === (int) $subject->id)>
                        {{ $subject->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="field">
            <label for="url">الرابط (اختياري)</label>
            <input id="url" type="url" name="url" value="{{ old('url') }}" placeholder="https://...">
        </div>

        <div class="field">
            <label for="media">ملف وسائط (اختياري)</label>
            <input id="media" type="file" name="media" accept="video/*,audio/*">
            <p class="meta">يمكنك إدخال رابط أو رفع ملف صوت/فيديو فقط.</p>
        </div>

        <div class="actions">
            <button class="btn" type="submit">حفظ المحاضرة</button>
            <a class="btn-link btn-light" href="{{ route('lectures.index') }}">إلغاء</a>
        </div>
    </form>
@endsection
