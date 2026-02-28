@extends('users.layout')

@section('title', 'إضافة عظة - مركز البابا شنوده')
@section('page_title', 'إضافة عظة جديدة')

@section('content')
    @php($type = $activeType ?? 'historical')

    <div class="actions" style="margin-bottom: 12px;">
        <a class="btn-link {{ $type === 'historical' ? '' : 'btn-light' }}" href="{{ route('sermons.historical.create') }}">إنشاء عظة تاريخية</a>
        <a class="btn-link {{ $type === 'trips' ? '' : 'btn-light' }}" href="{{ route('sermons.trips.create') }}">إنشاء عظة رحلة</a>
    </div>

    <form method="POST" action="{{ $type === 'trips' ? route('sermons.trips.store') : route('sermons.historical.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="field">
            <label for="title">العنوان</label>
            <input id="title" type="text" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="field">
            <label for="sermon_playlist_id">قائمة العظات</label>
            <select id="sermon_playlist_id" name="sermon_playlist_id" required>
                <option value="">اختر القائمة</option>
                @foreach ($playlists as $playlist)
                    <option value="{{ $playlist->id }}" @selected((int) old('sermon_playlist_id') === (int) $playlist->id)>
                        {{ $playlist->title }}
                    </option>
                @endforeach
            </select>
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

        <button class="btn" type="submit">حفظ العظة</button>
    </form>

    @include('partials.url_or_file_toggle', ['urlId' => 'url', 'fileId' => 'file'])
@endsection
