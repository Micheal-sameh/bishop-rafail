@extends('users.layout')

@section('title', 'الأفلام - مركز البابا شنوده')
@section('page_title', 'الأفلام')

@section('content')
    <div class="actions" style="margin-bottom: 12px;">
        <a class="btn-link" href="{{ route('films.create') }}">إضافة فيلم</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>الرابط</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($films as $key => $film)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $film->title }}</td>
                        <td><a class="btn-link btn-light" href="{{ $film->url }}" target="_blank">فتح</a></td>
                        <td>
                            <div class="actions">
                                <a class="btn-link btn-light" href="{{ route('films.show', $film) }}">عرض</a>
                                <a class="btn-link btn-light" href="{{ route('films.edit', $film) }}">تحديث</a>
                                <a class="btn-link" href="{{ route('films.delete', $film) }}">حذف</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="meta">لا توجد أفلام حالياً.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $films->links() }}
    </div>
@endsection
