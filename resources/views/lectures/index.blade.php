@extends('users.layout')

@section('title', 'المحاضرات - مركز البابا شنوده')
@section('page_title', 'المحاضرات')

@section('content')
    <div class="actions" style="margin-bottom: 12px;">
        <a class="btn-link" href="{{ route('lectures.create') }}">إضافة محاضرة</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>المادة</th>
                    <th>الرابط / الوسائط</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lectures as $key => $lecture)
                    @php($url = $lecture->url ?: $lecture->getFirstMediaUrl('lectures'))
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $lecture->title }}</td>
                        <td>{{ $lecture->subject?->title }}</td>
                        <td>
                            @if ($url)
                                <a class="btn-link btn-light" href="{{ $url }}" target="_blank">فتح</a>
                            @else
                                <span class="meta">—</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a class="btn-link btn-light" href="{{ route('lectures.show', $lecture) }}">عرض</a>
                                <a class="btn-link btn-light" href="{{ route('lectures.edit', $lecture) }}">تحديث</a>
                                <a class="btn-link" href="{{ route('lectures.delete', $lecture) }}">حذف</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="meta">لا توجد محاضرات حالياً.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @include('partials.pagination', ['paginator' => $lectures])
@endsection
