@extends('admin.layouts.admin')

@section('title', 'Quản lý Sản Phẩm')

@section('content')
<h2 class="mb-3">DANH SÁCH SẢN PHẨM</h2>

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Loại sản phẩm</th>
            <th>Thương hiệu</th>
            <th>Giá bán</th>
            <th>Giá giảm</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>
                <img src="{{ asset('images/' . ($item->image ?? 'default.png')) }}" alt="Product" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
            </td>
            <td class="fw-bold">{{ $item->productname }}</td>
            <td><span class="badge bg-info text-dark">{{ $item->category_name }}</span></td>
            <td>{{ $item->brand_name ?? 'Không có' }}</td>
            <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
            <td class="text-danger fw-bold">{{ number_format($item->pricediscount, 0, ',', '.') }}đ</td>
            <td>
                <span class="badge {{ $item->status == 1 ? 'bg-success' : 'bg-danger' }}">
                    {{ $item->status == 1 ? 'Mở bán' : 'Tạm ẩn' }}
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection