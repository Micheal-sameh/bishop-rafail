@extends('users.layout')

@section('title', 'حذف المحاضرة - مركز البابا شنوده')
@section('page_title', 'تأكيد حذف المحاضرة')

@section('content')
    <p class="meta">هل أنت متأكد من حذف المحاضرة التالية؟</p>

    <table style="margin-top: 12px;">
        <tbody>
            <tr>
                <th>العنوان</th>
                <td>{{ $lecture->title }}</td>
            </tr>
            <tr>
                <th>المادة</th>
                <td>{{ $lecture->subject?->title }}</td>
            </tr>
        </tbody>
    </table>

    <div class="actions" style="margin-top: 14px;">
        <form class="inline-form" method="POST" action="{{ route('lectures.destroy', $lecture) }}">
            @csrf
            @method('DELETE')
            <button class="btn" type="submit">تأكيد الحذف</button>
        </form>

        <a class="btn-link btn-light" href="{{ route('lectures.show', $lecture) }}">إلغاء</a>
    </div>
@endsection
