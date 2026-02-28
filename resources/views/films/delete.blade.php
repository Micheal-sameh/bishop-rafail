@extends('users.layout')

@section('title', 'حذف الفيلم - مركز البابا شنوده')
@section('page_title', 'تأكيد حذف الفيلم')

@section('content')
    <p class="meta">هل أنت متأكد من حذف الفيلم التالي؟</p>

    <table style="margin-top: 12px;">
        <tbody>
            <tr>
                <th>العنوان</th>
                <td>{{ $film->title }}</td>
            </tr>
        </tbody>
    </table>

    <div class="actions" style="margin-top: 14px;">
        <form class="inline-form" method="POST" action="{{ route('films.destroy', $film) }}">
            @csrf
            @method('DELETE')
            <button class="btn" type="submit">تأكيد الحذف</button>
        </form>

        <a class="btn-link btn-light" href="{{ route('films.show', $film) }}">إلغاء</a>
    </div>
@endsection
