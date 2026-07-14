@extends('admin.layouts.admin')
@section('title', 'Trash - Thương hiệu')
@section('content')
<h2 class="mb-3">DANH SÁCH THƯƠNG HIỆU - ĐANG CHỜ XÓA</h2>
<x-admin.alert />
<a href="{{ route('admin.brands.index') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i> Quay lại danh sách
</a>
<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>Mã thương hiệu</th>
            <th>Hình ảnh</th>
            <th>Tên thương hiệu</th>
            <th>Slug</th>
            <th>Trạng thái</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $item)
        <tr>
            <td>{{ $item->brandid }}</td>
            <td>
                @if ($item->image)
                    <img src="{{ asset('storage/brands/' . $item->image) }}" width="60" height="50" class="img-thumbnail" alt="no img">
                @else
                    <span class="text-muted">Không có ảnh</span>
                @endif
            </td>
            <td>{{ $item->brandname }}</td>
            <td>{{ $item->slug }}</td>
            <td>
                @if ($item->status == 1)
                    <span class="badge bg-success">Hiển thị</span>
                @else
                    <span class="badge bg-danger">Ẩn</span>
                @endif
            </td>
            <td>
                <form action="{{ route('admin.brands.restore', $item->brandid) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-success btn-sm">Khôi phục</button>
                </form>
                <form action="{{ route('admin.brands.forceDelete', $item->brandid) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn thương hiệu này?')" class="btn btn-danger btn-sm">
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
