@extends('users.layout')

@section('title', 'عرض الصورة - مركز البابا شنوده')
@section('page_title', 'عرض الصورة')

@section('content')
    <table>
        <tbody>
            <tr>
                <th>المعرف</th>
                <td>{{ $item->id }}</td>
            </tr>
            <tr>
                <th>الصورة</th>
                <td>
                    <a href="{{ $item->getFirstMediaUrl('gallery') }}" target="_blank">
                        <img src="{{ $item->getFirstMediaUrl('gallery') }}" alt="gallery" style="max-width:280px;border-radius:8px;">
                    </a>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="actions" style="margin-top: 14px;">
        <a class="btn-link" href="{{ route('gallery.delete', $item) }}">حذف</a>
        <a class="btn-link btn-light" href="{{ route('gallery.index') }}">رجوع</a>
    </div>
@endsection
