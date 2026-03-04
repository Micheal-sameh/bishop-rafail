@extends('users.layout')

@section('title', 'المواد - مركز البابا شنوده')
@section('page_title', 'المواد')

@section('content')
    <div class="actions" style="margin-bottom: 12px;">
        <a class="btn-link" href="{{ route('subjects.create') }}">إضافة مادة</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>السنة</th>
                    <th>أُضيف بواسطة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($subjects as $key => $subject)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $subject->title }}</td>
                        <td>{{ $subject->year }}</td>
                        <td>{{ $subject->creator?->name ?? '—' }}</td>
                        <td>
                            <div class="actions">
                                <a class="btn-link btn-light" href="{{ route('subjects.show', $subject) }}">عرض</a>
                                <a class="btn-link btn-light" href="{{ route('subjects.edit', $subject) }}">تحديث</a>
                                <a class="btn-link" href="{{ route('subjects.delete', $subject) }}">حذف</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="meta">لا توجد مواد حالياً.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @include('partials.pagination', ['paginator' => $subjects])
@endsection
