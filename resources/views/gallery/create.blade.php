@extends('users.layout')

@section('title', 'إضافة صورة - مركز البابا شنوده')
@section('page_title', 'إضافة صورة')

@section('content')
    <form method="POST" action="{{ route('gallery.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="field">
            <label for="images">الصور</label>
            <input id="images" type="file" name="images[]" multiple required>
            <p class="meta">يمكنك اختيار أكثر من صورة في نفس العملية.</p>
        </div>

        <button class="btn" type="submit">حفظ الصورة</button>
    </form>
@endsection
