@extends('admin.layouts.admin')
@section('title', 'Danh sách danh mục')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>DANH SÁCH DANH MỤC</h2>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Thêm mới
        </a>
        <a href="{{ route('admin.categories.trash') }}" class="btn btn-danger">
            <i class="bi bi-trash"></i> Thùng rác
        </a>
    </div>
</div>

<x-admin.alert />

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Mã danh mục</th>
            <th>Hình ảnh</th>
            <th>Tên danh mục</th>
            <th>Slug</th>
            <th>Trạng thái</th>
            <th class="text-center" style="width: 120px;">Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $index => $item)
        <tr>
            <td>{{ ($list->currentPage() - 1) * $list->perPage() + $index + 1 }}</td>
            <td>{{ $item->cateid }}</td>
            <td>
                @php
                    $imageUrl = $item->image 
                        ? asset('storage/categories/' . $item->image)
                        : asset('images/1.jpg');
                @endphp
                <img src="{{ $imageUrl }}" alt="Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
            </td>
            <td>{{ $item->catename }}</td>
            <td>{{ $item->slug }}</td>
            <td>
                <span class="badge {{ $item->status == 1 ? 'bg-success' : 'bg-danger' }}">
                    {{ $item->status == 1 ? 'Hiện' : 'Ẩn' }}
                </span>
            </td>
            <td class="text-center">
                <div class="d-flex gap-1 justify-content-center">
                    <a href="{{ route('admin.categories.edit', $item->cateid) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <form action="{{ route('admin.categories.destroy', $item->cateid) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i>
                        </button>
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