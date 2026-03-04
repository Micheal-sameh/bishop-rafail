@extends('users.layout')

@section('title', 'سجل العمليات - مركز البابا شنوده')
@section('page_title', 'سجل العمليات')

@section('content')
    <form method="GET" action="{{ route('audits.index') }}" style="margin-bottom: 12px;">
        <div class="table-wrap">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <label for="event">الحدث</label>
                            <select id="event" name="event">
                                <option value="">الكل</option>
                                @foreach ($eventOptions as $event)
                                    <option value="{{ $event }}" @selected(($filters['event'] ?? '') === $event)>{{ strtoupper((string) $event) }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <label for="auditable_type">الكيان</label>
                            <select id="auditable_type" name="auditable_type">
                                <option value="">الكل</option>
                                @foreach ($typeOptions as $type)
                                    <option value="{{ $type }}" @selected(($filters['auditable_type'] ?? '') === $type)>{{ class_basename((string) $type) }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <label for="user_id">المستخدم</label>
                            <select id="user_id" name="user_id">
                                <option value="">الكل</option>
                                @foreach ($userOptions as $user)
                                    <option value="{{ $user->id }}" @selected((int) ($filters['user_id'] ?? 0) === (int) $user->id)>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="from_date">من تاريخ</label>
                            <input id="from_date" type="date" name="from_date" value="{{ $filters['from_date'] ?? '' }}">
                        </td>
                        <td>
                            <label for="to_date">إلى تاريخ</label>
                            <input id="to_date" type="date" name="to_date" value="{{ $filters['to_date'] ?? '' }}">
                        </td>
                        <td>
                            <label for="per_page">عدد العناصر</label>
                            <select id="per_page" name="per_page">
                                @foreach ([15, 25, 50, 100] as $size)
                                    <option value="{{ $size }}" @selected((int) request('per_page', 15) === $size)>{{ $size }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="actions" style="margin-top: 8px;">
            <button class="btn" type="submit">تصفية</button>
            <a class="btn-link btn-light" href="{{ route('audits.index') }}">إعادة تعيين</a>
        </div>
    </form>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>الحدث</th>
                    <th>الكيان</th>
                    <th>رقم الكيان</th>
                    <th>المستخدم</th>
                    <th>أُضيف بواسطة</th>
                    <th>التاريخ</th>
                    <th>التفاصيل</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($audits as $key => $audit)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ strtoupper((string) $audit->event) }}</td>
                        <td>{{ class_basename((string) $audit->auditable_type) }}</td>
                        <td>{{ $audit->auditable_id }}</td>
                        <td>{{ $audit->user?->name ?? '—' }}</td>
                        <td>{{ $audit->creator?->name ?? '—' }}</td>
                        <td>{{ $audit->created_at?->format('Y-m-d H:i') }}</td>
                        <td><a class="btn-link btn-light" href="{{ route('audits.show', $audit) }}">عرض التغييرات</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="meta">لا توجد عمليات تدقيق حالياً.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @include('partials.pagination', ['paginator' => $audits])
@endsection
