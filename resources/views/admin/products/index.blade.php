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
