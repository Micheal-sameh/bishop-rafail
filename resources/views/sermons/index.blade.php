@extends('users.layout')

@section('title', 'العظات - مركز البابا شنوده')
@section('page_title', 'العظات')

@section('content')
    @php($type = $activeType ?? 'historical')

    <div class="actions" style="margin-bottom: 12px;">
        <a class="btn-link {{ $type === 'historical' ? '' : 'btn-light' }}" href="{{ route('sermons.historical.index') }}">العظات التاريخية</a>
        <a class="btn-link {{ $type === 'trips' ? '' : 'btn-light' }}" href="{{ route('sermons.trips.index') }}">عظات الرحلات</a>
    </div>

    <div class="actions" style="margin-bottom: 12px;">
        <a class="btn-link" href="{{ $type === 'trips' ? route('sermons.trips.create') : route('sermons.historical.create') }}">إضافة عظة جديدة</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>القائمة</th>
                    <th>الرابط</th>
                    <th>أُضيف بواسطة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sermons as $key => $sermon)
                    @php($media = $sermon->getFirstMedia('sermon_files'))
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $sermon->title }}</td>
                        <td>{{ $sermon->playlist?->title }}</td>
                        <td>
                            @if ($sermon->url)
                                <a class="btn-link btn-light" href="{{ $sermon->url }}" target="_blank">فتح الرابط</a>
                            @else
                                <a class="btn-link btn-light" href="{{ $sermon->getFirstMediaUrl('sermons') }}" target="_blank">فتح الرابط</a>
                            @endif
                        </td>
                        <td>{{ $sermon->creator?->name ?? '—' }}</td>
                        <td>
                            <div class="actions">
                                <a class="btn-link btn-light" href="{{ route('sermons.show', $sermon) }}">عرض</a>
                                <a class="btn-link btn-light" href="{{ route('sermons.edit', $sermon) }}">تحديث</a>
                                <a class="btn-link" href="{{ route('sermons.delete', $sermon) }}">حذف</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="meta">لا توجد عظات حالياً.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @include('partials.pagination', ['paginator' => $sermons])
@endsection
