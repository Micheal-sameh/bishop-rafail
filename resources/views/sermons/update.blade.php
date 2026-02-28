@extends('users.layout')

@section('title', 'تحديث العظة - مركز البابا شنوده')
@section('page_title', 'تحديث العظة')

@section('content')
    @php($media = $sermon->getFirstMedia('sermon_files'))

    <form method="POST" action="{{ route('sermons.update', $sermon) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="field">
            <label for="title">العنوان</label>
            <input id="title" type="text" name="title" value="{{ old('title', $sermon->title) }}" required>
        </div>

        <div class="field">
            <label for="sermon_playlist_id">قائمة العظات</label>
            <select id="sermon_playlist_id" name="sermon_playlist_id" required>
                @foreach ($playlists as $playlist)
                    <option value="{{ $playlist->id }}" @selected((int) old('sermon_playlist_id', $sermon->sermon_playlist_id) === (int) $playlist->id)>
                        {{ $playlist->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="field">
            <label for="url">رابط (اختياري)</label>
            <input id="url" type="url" name="url" value="{{ old('url', $sermon->url) }}" placeholder="https://...">
        </div>

        <div class="field">
            <label for="file">ملف جديد (اختياري)</label>
            <input id="file" type="file" name="file">
            @if ($media)
                <p class="meta">يوجد ملف مرفوع حالياً: <a href="{{ $media->getUrl() }}" target="_blank">عرض الملف</a></p>
            @endif
            <p class="meta">اختر رابط أو ملف فقط، وليس الاثنين معاً.</p>
        </div>

        <div class="actions">
            <button class="btn" type="submit">حفظ التحديث</button>
            <a class="btn-link btn-light" href="{{ route('sermons.show', $sermon) }}">إلغاء</a>
        </div>
    </form>
@endsection
