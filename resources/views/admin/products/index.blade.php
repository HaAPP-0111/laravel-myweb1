@extends('admin.layouts.admin')
@section('title', 'Quản lý Sản Phẩm')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>DANH SÁCH SẢN PHẨM</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-success">+ Thêm mới</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Mã SP</th>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Danh mục</th>
            <th>Giá gốc</th>
            <th>Giá giảm</th>
            <th>Trạng thái</th>
            <th class="text-center" style="width: 100px;">Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $index => $item)
        <tr>
            <td>{{ ($list->currentPage() - 1) * $list->perPage() + $index + 1 }}</td>
            
            <td>{{ $item->id }}</td>
            
            <td>
                <img src="{{ asset('images/' . ($item->image ?? 'default.png')) }}" alt="Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
            </td>
            <td>{{ $item->productname }}</td>
            
            <td>{{ $item->category_name ?? 'Không rõ' }}</td>
            
            <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
            <td>{{ number_format($item->pricediscount, 0, ',', '.') }} đ</td>
            <td>
                <span class="badge {{ $item->status == 1 ? 'bg-success' : 'bg-danger' }}">
                    {{ $item->status == 1 ? 'Mở bán' : 'Bán hết / Ẩn' }}
                </span>
            </td>
            <td class="text-center">
                <form action="{{ route('admin.products.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
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