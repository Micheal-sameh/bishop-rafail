@extends('users.layout')

@section('title', 'حذف قائمة عظات - مركز البابا شنوده')
@section('page_title', 'تأكيد حذف قائمة عظات')

@section('content')
    <p class="meta">هل أنت متأكد من حذف القائمة التالية؟</p>

    <table style="margin-top: 12px;">
        <tbody>
            <tr>
                <th>العنوان</th>
                <td>{{ $playlist->title }}</td>
            </tr>
            <tr>
                <th>النوع</th>
                <td>{{ $typeLabel((int) $playlist->type) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="actions" style="margin-top: 14px;">
        <form class="inline-form" method="POST" action="{{ route('sermons-playlists.destroy', $playlist) }}">
            @csrf
            @method('DELETE')
            <button class="btn" type="submit">تأكيد الحذف</button>
        </form>

        <a class="btn-link btn-light" href="{{ route('sermons-playlists.show', $playlist) }}">إلغاء</a>
    </div>
@endsection
