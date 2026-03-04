@extends('users.layout')

@section('title', 'تفاصيل التدقيق - مركز البابا شنوده')
@section('page_title', 'تفاصيل التدقيق')

@section('content')
    <table>
        <tbody>
            <tr>
                <th>المعرف</th>
                <td>{{ $audit->id }}</td>
            </tr>
            <tr>
                <th>الحدث</th>
                <td>{{ strtoupper((string) $audit->event) }}</td>
            </tr>
            <tr>
                <th>الكيان</th>
                <td>{{ class_basename((string) $audit->auditable_type) }}</td>
            </tr>
            <tr>
                <th>رقم الكيان</th>
                <td>{{ $audit->auditable_id }}</td>
            </tr>
            <tr>
                <th>المستخدم</th>
                <td>{{ $audit->user?->name ?? '—' }}</td>
            </tr>
            <tr>
                <th>أُضيف بواسطة</th>
                <td>{{ $audit->creator?->name ?? '—' }}</td>
            </tr>
            <tr>
                <th>التاريخ</th>
                <td>{{ $audit->created_at?->format('Y-m-d H:i:s') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="table-wrap" style="margin-top: 14px;">
        <table>
            <thead>
                <tr>
                    <th>الحقل</th>
                    <th>القيمة القديمة</th>
                    <th>القيمة الجديدة</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($changesKeys as $field)
                    <tr>
                        <td>{{ $field }}</td>
                        <td>{{ json_encode($oldValues[$field] ?? null, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) }}</td>
                        <td>{{ json_encode($newValues[$field] ?? null, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="meta">لا توجد تغييرات محفوظة لهذه العملية.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="actions" style="margin-top: 14px;">
        <a class="btn-link btn-light" href="{{ route('audits.index') }}">رجوع إلى السجل</a>
    </div>
@endsection
