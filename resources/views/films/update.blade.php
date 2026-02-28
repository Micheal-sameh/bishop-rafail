@extends('users.layout')

@section('title', 'تحديث الفيلم - مركز البابا شنوده')
@section('page_title', 'تحديث الفيلم')

@section('content')
    <form method="POST" action="{{ route('films.update', $film) }}">
        @csrf
        @method('PUT')

        <div class="field">
            <label for="title">العنوان</label>
            <input id="title" type="text" name="title" value="{{ old('title', $film->title) }}" required>
        </div>

        <div class="field">
            <label for="url">الرابط</label>
            <input id="url" type="url" name="url" value="{{ old('url', $film->url) }}" required>
        </div>

        <div class="actions">
            <button class="btn" type="submit">حفظ التحديث</button>
            <a class="btn-link btn-light" href="{{ route('films.show', $film) }}">إلغاء</a>
        </div>
    </form>
@endsection
