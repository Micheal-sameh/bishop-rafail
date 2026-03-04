@extends('users.layout')

@section('title', 'قوائم العظات - مركز البابا شنوده')
@section('page_title', 'قوائم العظات')

@section('content')
    <div class="actions" style="margin-bottom: 12px;">
        <a class="btn-link" href="{{ route('sermons-playlists.create') }}">إضافة قائمة جديدة</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>النوع</th>
                    <th>أُضيف بواسطة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($playlists as $key => $playlist)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $playlist->title }}</td>
                        <td>{{ $typeLabel((int) $playlist->type) }}</td>
                        <td>{{ $playlist->creator?->name ?? '—' }}</td>
                        <td>
                            <div class="actions">
                                <a class="btn-link btn-light" href="{{ route('sermons-playlists.show', $playlist) }}">عرض</a>
                                <a class="btn-link btn-light" href="{{ route('sermons-playlists.edit', $playlist) }}">تحديث</a>
                                <a class="btn-link" href="{{ route('sermons-playlists.delete', $playlist) }}">حذف</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="meta">لا توجد قوائم عظات حالياً.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @include('partials.pagination', ['paginator' => $playlists])
@endsection
