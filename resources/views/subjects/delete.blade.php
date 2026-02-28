@extends('users.layout')

@section('title', 'حذف المادة - مركز البابا شنوده')
@section('page_title', 'تأكيد حذف المادة')

@section('content')
    <p class="meta">هل أنت متأكد من حذف المادة التالية؟</p>

    <table style="margin-top: 12px;">
        <tbody>
            <tr>
                <th>العنوان</th>
                <td>{{ $subject->title }}</td>
            </tr>
            <tr>
                <th>السنة</th>
                <td>{{ $subject->year }}</td>
            </tr>
        </tbody>
    </table>

    <div class="actions" style="margin-top: 14px;">
        <form class="inline-form" method="POST" action="{{ route('subjects.destroy', $subject) }}">
            @csrf
            @method('DELETE')
            <button class="btn" type="submit">تأكيد الحذف</button>
        </form>

        <a class="btn-link btn-light" href="{{ route('subjects.show', $subject) }}">إلغاء</a>
    </div>
@endsection
