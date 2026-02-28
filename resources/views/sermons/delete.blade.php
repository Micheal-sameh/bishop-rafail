@extends('users.layout')

@section('title', 'حذف العظة - مركز البابا شنوده')
@section('page_title', 'تأكيد حذف العظة')

@section('content')
    <p class="meta">هل أنت متأكد من حذف العظة التالية؟</p>

    <table style="margin-top: 12px;">
        <tbody>
            <tr>
                <th>العنوان</th>
                <td>{{ $sermon->title }}</td>
            </tr>
            <tr>
                <th>قائمة العظات</th>
                <td>{{ $sermon->playlist?->title }}</td>
            </tr>
        </tbody>
    </table>

    <div class="actions" style="margin-top: 14px;">
        <form class="inline-form" method="POST" action="{{ route('sermons.destroy', $sermon) }}">
            @csrf
            @method('DELETE')
            <button class="btn" type="submit">تأكيد الحذف</button>
        </form>

        <a class="btn-link btn-light" href="{{ route('sermons.show', $sermon) }}">إلغاء</a>
    </div>
@endsection
