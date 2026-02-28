@extends('users.layout')

@section('title', 'قائمة المستخدمين - مركز البابا شنوده')
@section('page_title', 'قائمة المستخدمين')

@section('content')
    <div class="actions" style="margin-bottom: 12px;">
        <a class="btn-link" href="{{ route('users.create') }}">إضافة مستخدم جديد</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>الهاتف</th>
                    <th>البريد الإلكتروني</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ (int) $user->status === 2 ? 'مُفعّل' : 'غير مُفعّل' }}</td>
                        <td>
                            <div class="actions">
                                <a class="btn-link btn-light" href="{{ route('users.show', $user) }}">عرض</a>
                                <a class="btn-link btn-light" href="{{ route('users.edit', $user) }}">تحديث</a>
                                <a class="btn-link" href="{{ route('users.delete', $user) }}">حذف</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="meta">لا يوجد مستخدمون حالياً.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $users->links() }}
    </div>
@endsection
