@extends('users.layout')

@section('title', 'حذف المستند - مركز البابا شنوده')
@section('page_title', 'تأكيد حذف المستند')

@section('content')
    <p class="meta">هل أنت متأكد من حذف المستند التالي؟</p>

    <table style="margin-top: 12px;">
        <tbody>
            <tr>
                <th>العنوان</th>
                <td>{{ $document->title }}</td>
            </tr>
            <tr>
                <th>النوع</th>
                <td>{{ \App\Enums\BooksTypes::getStringValue((int) $document->type) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="actions" style="margin-top: 14px;">
        <form class="inline-form" method="POST" action="{{ route('documents.destroy', $document) }}">
            @csrf
            @method('DELETE')
            <button class="btn" type="submit">تأكيد الحذف</button>
        </form>

        <a class="btn-link btn-light" href="{{ route('documents.show', $document) }}">إلغاء</a>
    </div>
@endsection
