@extends('users.layout')

@section('title', 'إضافة قائمة عظات - مركز البابا شنوده')
@section('page_title', 'إضافة قائمة عظات')

@section('content')
    <form method="POST" action="{{ route('sermons-playlists.store') }}">
        @csrf

        <div class="field">
            <label for="title">العنوان</label>
            <input id="title" type="text" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="field">
            <label for="type">النوع</label>
            <select id="type" name="type" required>
                <option value="">اختر النوع</option>
                @foreach ($types as $type)
                    <option value="{{ $type['value'] }}" @selected((int) old('type') === (int) $type['value'])>
                        {{ $type['name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn" type="submit">حفظ القائمة</button>
    </form>
@endsection
