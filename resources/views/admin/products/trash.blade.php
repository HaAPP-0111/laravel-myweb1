@extends('admin.layouts.admin')
@section('title', 'Trash - Sản phẩm')
@section('content')
<h2 class="mb-3">DANH SÁCH SẢN PHẨM - ĐANG CHỜ XÓA</h2>
<x-admin.alert />
<a href="{{ route('admin.products.index') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i> Quay lại danh sách
</a>
<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>Mã SP</th>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Giá gốc</th>
            <th>Giá giảm</th>
            <th>Trạng thái</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>
                @if ($item->image)
                    <img src="{{ asset('storage/products/' . $item->image) }}" width="60" height="50" class="img-thumbnail" alt="no img">
                @else
                    <span class="text-muted">Không có ảnh</span>
                @endif
            </td>
            <td>{{ $item->productname }}</td>
            <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
            <td>{{ number_format($item->pricediscount, 0, ',', '.') }} đ</td>
            <td>
                @if ($item->status == 1)
                    <span class="badge bg-success">Mở bán</span>
                @else
                    <span class="badge bg-danger">Ẩn</span>
                @endif
            </td>
            <td>
                <form action="{{ route('admin.products.restore', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-success btn-sm">Khôi phục</button>
                </form>
                <form action="{{ route('admin.products.forceDelete', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn sản phẩm này?')" class="btn btn-danger btn-sm">
                        Xóa
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
        @if($list->isEmpty())
        <tr>
            <td colspan="7" class="text-center text-muted">Thùng rác trống.</td>
        </tr>
        @endif
    </tbody>
</table>
<div class="d-flex justify-content-center mt-3">
    {{ $list->links() }}
</div>
@endsection
