@extends('users.layout')

@section('title', 'حذف الصورة - مركز البابا شنوده')
@section('page_title', 'تأكيد حذف الصورة')

@section('content')
    <p class="meta">هل أنت متأكد من حذف هذه الصورة؟</p>

    <div style="margin: 12px 0;">
        <img src="{{ $item->getFirstMediaUrl('gallery') }}" alt="gallery" style="max-width:280px;border-radius:8px;">
    </div>

    <div class="actions" style="margin-top: 14px;">
        <form class="inline-form" method="POST" action="{{ route('gallery.destroy', $item) }}">
            @csrf
            @method('DELETE')
            <button class="btn" type="submit">تأكيد الحذف</button>
        </form>

        <a class="btn-link btn-light" href="{{ route('gallery.show', $item) }}">إلغاء</a>
    </div>
@endsection
