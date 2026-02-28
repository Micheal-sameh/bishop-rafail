@extends('users.layout')

@section('title', 'إضافة فيلم - مركز البابا شنوده')
@section('page_title', 'إضافة فيلم')

@section('content')
    <form method="POST" action="{{ route('films.store') }}">
        @csrf

        <div class="field">
            <label for="title">العنوان</label>
            <input id="title" type="text" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="field">
            <label for="url">الرابط</label>
            <input id="url" type="url" name="url" value="{{ old('url') }}" required>
        </div>

        <button class="btn" type="submit">حفظ الفيلم</button>
    </form>
@endsection
