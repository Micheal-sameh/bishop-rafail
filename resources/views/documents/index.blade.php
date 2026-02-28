@extends('users.layout')

@section('title', 'المستندات - مركز البابا شنوده')
@section('page_title', 'المستندات')

@section('content')
    @php($type = $activeType ?? 'historical')

    <div class="actions" style="margin-bottom: 12px;">
        <a class="btn-link {{ $type === 'historical' ? '' : 'btn-light' }}" href="{{ route('documents.historical.index') }}">تاريخية</a>
        <a class="btn-link {{ $type === 'produced' ? '' : 'btn-light' }}" href="{{ route('documents.produced.index') }}">اصدارات المركز</a>
        <a class="btn-link {{ $type === 'artical' ? '' : 'btn-light' }}" href="{{ route('documents.artical.index') }}">مقالات</a>
    </div>

    <div class="actions" style="margin-bottom: 12px;">
        <a class="btn-link" href="{{ route("documents.{$type}.create") }}">إضافة مستند</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>النوع</th>
                    <th>الرابط</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($documents as $key => $document)
                    @php($url = $document->url ?: $document->getFirstMediaUrl('documents'))
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $document->title }}</td>
                        <td>{{ \App\Enums\BooksTypes::getStringValue((int) $document->type) }}</td>
                        <td>
                            @if ($url)
                                <a class="btn-link btn-light" href="{{ $url }}" target="_blank">فتح</a>
                            @else
                                <span class="meta">—</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a class="btn-link btn-light" href="{{ route('documents.show', $document) }}">عرض</a>
                                <a class="btn-link btn-light" href="{{ route('documents.edit', $document) }}">تحديث</a>
                                <a class="btn-link" href="{{ route('documents.delete', $document) }}">حذف</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="meta">لا توجد مستندات حالياً.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $documents->links() }}
    </div>
@endsection
