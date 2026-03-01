@extends('users.layout')

@section('title', 'المعرض - مركز البابا شنوده')
@section('page_title', 'المعرض')

@section('content')
    <div class="actions" style="margin-bottom: 12px;">
        <a class="btn-link" href="{{ route('gallery.create') }}">إضافة صورة</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>الصورة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <a href="{{ $item->getFirstMediaUrl('gallery') }}" target="_blank">
                                <img src="{{ $item->getFirstMediaUrl('gallery') }}" alt="gallery" style="height:72px;border-radius:8px;">
                            </a>
                        </td>
                        <td>
                            <div class="actions">
                                <a class="btn-link btn-light" href="{{ route('gallery.show', $item) }}">عرض</a>
                                <a class="btn-link" href="{{ route('gallery.delete', $item) }}">حذف</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="meta">لا توجد صور حالياً.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @include('partials.pagination', ['paginator' => $items])
@endsection
