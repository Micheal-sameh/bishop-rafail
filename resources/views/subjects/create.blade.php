@extends('users.layout')

@section('title', 'إضافة مادة - مركز البابا شنوده')
@section('page_title', 'إضافة مادة')

@section('content')
    <form method="POST" action="{{ route('subjects.store') }}">
        @csrf

        <div class="field">
            <label for="title">العنوان</label>
            <input id="title" type="text" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="field">
            <label for="year">السنة</label>
            @php
                $selectedYear = (int) old('year', now()->year);
            @endphp
            <select id="year" name="year" required>
                @for ($year = now()->year; $year >= 2000; $year--)
                    <option value="{{ $year }}" @selected($selectedYear === $year)>{{ $year }}</option>
                @endfor
            </select>
        </div>

        <div class="actions">
            <button class="btn" type="submit">حفظ المادة</button>
            <a class="btn-link btn-light" href="{{ route('subjects.index') }}">إلغاء</a>
        </div>
    </form>
@endsection
