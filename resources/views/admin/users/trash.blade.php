@extends('admin.layouts.admin')
@section('title', 'Trash - Người dùng')
@section('content')
<h2 class="mb-3">DANH SÁCH NGƯỜI DÙNG - ĐANG CHỜ XÓA</h2>
<x-admin.alert />
<a href="{{ route('admin.users.index') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i> Quay lại danh sách
</a>
<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>Mã số</th>
            <th>Tài khoản</th>
            <th>Họ và tên</th>
            <th>Email</th>
            <th>Trạng thái</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->username }}</td>
            <td>{{ $item->fullname }}</td>
            <td>{{ $item->email }}</td>
            <td>
                @if ($item->status == 1)
                    <span class="badge bg-success">Hoạt động</span>
                @else
                    <span class="badge bg-danger">Khóa</span>
                @endif
            </td>
            <td>
                <form action="{{ route('admin.users.restore', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-success btn-sm">Khôi phục</button>
                </form>
                <form action="{{ route('admin.users.forceDelete', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn người dùng này?')" class="btn btn-danger btn-sm">
                        Xóa
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
        @if($list->isEmpty())
        <tr>
            <td colspan="6" class="text-center text-muted">Thùng rác trống.</td>
        </tr>
        @endif
    </tbody>
</table>
<div class="d-flex justify-content-center mt-3">
    {{ $list->links() }}
</div>
@endsection
