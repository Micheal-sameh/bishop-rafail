@extends('users.layout')

@section('title', 'تحديث المادة - مركز البابا شنوده')
@section('page_title', 'تحديث المادة')

@section('content')
    <form method="POST" action="{{ route('subjects.update', $subject) }}">
        @csrf
        @method('PUT')

        <div class="field">
            <label for="title">العنوان</label>
            <input id="title" type="text" name="title" value="{{ old('title', $subject->title) }}" required>
        </div>

        <div class="field">
            <label for="year">السنة</label>
            <input id="year" type="number" name="year" value="{{ old('year', $subject->year) }}" min="1900" max="2100" required>
        </div>

        <div class="actions">
            <button class="btn" type="submit">حفظ التحديث</button>
            <a class="btn-link btn-light" href="{{ route('subjects.show', $subject) }}">إلغاء</a>
        </div>
    </form>
@endsection
