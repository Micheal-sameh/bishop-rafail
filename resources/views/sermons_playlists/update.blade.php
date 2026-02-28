@extends('users.layout')

@section('title', 'تحديث قائمة العظات - مركز البابا شنوده')
@section('page_title', 'تحديث قائمة العظات')

@section('content')
    <form method="POST" action="{{ route('sermons-playlists.update', $playlist) }}">
        @csrf
        @method('PUT')

        <div class="field">
            <label for="title">العنوان</label>
            <input id="title" type="text" name="title" value="{{ old('title', $playlist->title) }}" required>
        </div>

        <div class="field">
            <label for="type">النوع</label>
            <select id="type" name="type" required>
                @foreach ($types as $type)
                    <option value="{{ $type['value'] }}" @selected((int) old('type', $playlist->type) === (int) $type['value'])>
                        {{ $type['name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="actions">
            <button class="btn" type="submit">حفظ التحديث</button>
            <a class="btn-link btn-light" href="{{ route('sermons-playlists.show', $playlist) }}">إلغاء</a>
        </div>
    </form>
@endsection
