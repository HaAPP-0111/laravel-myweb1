<<<<<<< HEAD
@extends('admin.layouts.admin')

@section('title', 'Quản lý Loại Sản Phẩm')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>DANH SÁCH LOẠI SẢN PHẨM</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-success">+ Thêm mới</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Mã loại</th>
            <th>Hình ảnh</th>
            <th>Tên loại</th>
            <th>Slug</th>
            <th>Trạng thái</th>
            <th class="text-center" style="width: 150px;">Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->cateid }}</td>
            <td>
                <img src="{{ asset('images/' . ($item->image ?? 'R.jpg')) }}" alt="Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
            </td>
            <td>{{ $item->catename }}</td>
            <td>{{ $item->slug }}</td>
            <td>
                <span class="badge {{ $item->status == 1 ? 'bg-success' : 'bg-danger' }}">
                    {{ $item->status == 1 ? 'Hiển thị' : 'Ẩn' }}
                </span>
            </td>
            <td class="text-center">
                <div class="d-flex gap-1 justify-content-center">
                    <a href="{{ route('admin.categories.edit', $item->cateid) }}" class="btn btn-warning btn-sm text-white">
                        Sửa
                    </a>

                    <form action="{{ route('admin.categories.destroy', $item->cateid) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center mt-3">
    {{ $list->links() }}
</div>
@endsection
=======
﻿{{-- Thừa kế layout từ view admin.blade.php --}}
@extends('admin.layouts.admin')

{{-- Gán nội dung cho vùng section 'title' --}}
@section('title', 'Loại Sản Phẩm')

{{-- Gán nội dung cho vùng section 'content' --}}
@section('content')
<h2 class="mb-3">DANH SÁCH LOẠI SẢN PHẨM</h2>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">
    <i class="bi bi-plus-circle me-1"></i> Thêm mới
</a>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th class="text-center" style="width: 100px;">Mã loại</th>
                <th>Tên loại</th>
                <th>Slug</th>
                <th class="text-center" style="width: 120px;">Số sản phẩm</th>
                <th class="text-center" style="width: 130px;">Trạng thái</th>
                <th class="text-center" style="width: 260px;">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @forelse($list as $item)
            <tr>
                <td class="text-center">{{ $item->cateid }}</td>
                <td>{{ $item->catename }}</td>
                <td><code class="text-muted">{{ $item->slug }}</code></td>
                <td class="text-center">{{ $item->products_count }}</td>
                <td class="text-center">
                    @if($item->status == 1)
                        <span class="badge bg-success">Hiển thị</span>
                    @else
                        <span class="badge bg-danger">Ẩn</span>
                    @endif
                </td>
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.categories.show', $item->cateid) }}" class="btn btn-info btn-sm px-2">
                            <i class="bi bi-box-seam"></i> Sản phẩm
                        </a>
                        <a href="{{ route('admin.categories.edit', $item->cateid) }}" class="btn btn-primary btn-sm px-2">
                            <i class="bi bi-pencil-square"></i> Sửa
                        </a>
                        <form action="{{ route('admin.categories.destroy', $item->cateid) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa loại sản phẩm này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm px-2">
                                <i class="bi bi-trash-fill"></i> Xóa
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted py-3">Không có loại sản phẩm nào.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $list->links() }}
</div>
@endsection
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
