@extends('admin.layouts.admin')
@section('title', 'Quản lý Thương Hiệu')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>DANH SÁCH THƯƠNG HIỆU</h2>
    <a href="{{ route('admin.brands.create') }}" class="btn btn-success">+ Thêm mới</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Mã thương hiệu</th>
            <th>Hình ảnh</th>
            <th>Tên thương hiệu</th>
            <th>Slug</th>
            <th>Trạng thái</th>
            <th class="text-center" style="width: 100px;">Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $index => $item)
        <tr>
            <td>{{ ($list->currentPage() - 1) * $list->perPage() + $index + 1 }}</td>
            <td>{{ $item->brandid }}</td>
            <td>
                <img src="{{ asset('images/' . ($item->image ?? 'R.jpg')) }}" alt="Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
            </td>
            <td>{{ $item->brandname }}</td>
            <td>{{ $item->slug }}</td>
            <td>
                <span class="badge {{ $item->status == 1 ? 'bg-success' : 'bg-danger' }}">
                    {{ $item->status == 1 ? 'Hiển thị' : 'Ẩn' }}
                </span>
            </td>
            <td class="text-center">
                <form action="{{ route('admin.brands.destroy', $item->brandid) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center mt-3">
    {{ $list->links() }}
</div>
@endsection