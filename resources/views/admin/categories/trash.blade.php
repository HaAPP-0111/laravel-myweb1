@extends('admin.layouts.admin')
@section('title', 'Trash-Loại Sản phẩm')
@section('content')
<h2 class="mb-3">DANH SÁCH LOẠI SẢN PHẨM - ĐANG CHỜ XÓA</h2>
{{-- gọi component --}}
<x-admin.alert />
<a href="{{ route('admin.categories.index') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i> Quay lại danh sách
</a>
<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>Mã loại</th>
            <th>Hình ảnh</th>
            <th>Tên loại</th>
            <th>Slug</th>
            <th>Trạng thái</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $item)
        <tr>
            <td>{{ $item->cateid }}</td>
            <td>
                @if ($item->image)
                    <img src="{{ asset('storage/categories/' . $item->image) }}" width="60" height="50" class="img-thumbnail" alt="no img">
                @else
                    <span class="text-muted">Không có ảnh</span>
                @endif
            </td>
            <td>{{ $item->catename }}</td>
            <td>{{ $item->slug }}</td>
            <td>
                @if ($item->status == 1)
                    <span class="badge bg-success">Hiển thị</span>
                @else
                    <span class="badge bg-danger">Ẩn</span>
                @endif
            </td>
            <td>
                <form action="{{ route('admin.categories.restore', $item->cateid) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-success btn-sm">Khôi phục</button>
                </form>
                <form action="{{ route('admin.categories.forceDelete', $item->cateid) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn danh mục này?')" class="btn btn-danger btn-sm">
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
{{-- hiển thị phân trang --}}
<div class="d-flex justify-content-center mt-3">
    {{ $list->links() }}
</div>
@endsection
