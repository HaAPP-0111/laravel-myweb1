<<<<<<< HEAD
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
            <th class="text-center" style="width: 120px;">Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $index => $item)
        <tr>
            <td>{{ ($list->currentPage() - 1) * $list->perPage() + $index + 1 }}</td>

            <td>{{ $item->id }}</td>

            <td>
                <img src="{{ asset('images/' . ($item->image ?? 'R.jpg')) }}" alt="Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
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
                <a href="{{ route('admin.products.edit', $item->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil-square"></i>
                </a>

                <form action="{{ route('admin.products.destroy', $item->id) }}" method="POST"
                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i>
                    </button>
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
=======
{{-- Thừa kế layout từ view admin.blade.php --}}
@extends('admin.layouts.admin')

{{-- Gán nội dung cho vùng section 'title' --}}
@section('title', 'Sản phẩm')

{{-- Gán nội dung cho vùng section 'content' --}}
@section('content')
<h2 class="mb-3">DANH SÁCH SẢN PHẨM</h2>

@if(!empty($categoryName))
    <div class="alert alert-info">
        Hiển thị sản phẩm thuộc danh mục: <strong>{{ $categoryName }}</strong>
    </div>
@endif

@php
    $defaultImage = asset('default.png');
@endphp

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th style="width:70px">STT</th>
            <th style="width:90px">Ảnh</th>
            <th style="width:90px">ID</th>
            <th>Tên sản phẩm</th>
            <th>Slug</th>
            <th style="width:140px">Giá</th>
            <th style="width:160px">Giá giảm</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th style="width:120px">Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $item)
            @php
                $candidate = $item->image ?? null;
                $imageUrl = ($candidate && file_exists(public_path($candidate)))
                    ? asset($candidate)
                    : $defaultImage;
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <img src="{{ $imageUrl }}" alt="{{ $item->productname }}" style="width:60px;height:60px;object-fit:cover;" class="rounded border" />
                </td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->productname }}</td>
                <td>{{ $item->slug }}</td>
                <td>{{ number_format($item->price, 0, ',', '.') }}</td>
                <td>{{ number_format($item->pricediscount, 0, ',', '.') }}</td>
                <td>{{ $item->category_name }}</td>
                <td>{{ $item->brand_name ?? '' }}</td>
                <td>
                    @if($item->status == 1)
                        <span class="badge bg-success">Hiển thị</span>
                    @else
                        <span class="badge bg-danger">Ẩn</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
