@extends('admin.layouts.admin')
@section('title', 'Thêm Sản Phẩm')
@section('content')
<div class="card p-4 shadow-sm" style="max-width: 700px; margin: 0 auto;">
    <h3 class="mb-4 text-primary fw-bold">THÊM SẢN PHẨM MỚI</h3>
    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold">Tên sản phẩm</label>
            <input type="text" name="productname" class="form-control" value="{{ old('productname') }}" placeholder="Nhập tên mặt hàng..." required>
            @error('productname')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label fw-bold">Slug (Không bắt buộc)</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="Để trống tự động tạo slug...">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Danh mục sản phẩm</label>
                <select name="cateid" class="form-select" required>
                    <option value="">-- Chọn danh mục --</option>
                    @foreach($categories as $cate)
                        <option value="{{ $cate->cateid }}" {{ old('cateid') == $cate->cateid ? 'selected' : '' }}>{{ $cate->catename }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Thương hiệu</label>
                <select name="brandid" class="form-select" required>
                    <option value="">-- Chọn thương hiệu --</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->brandid }}" {{ old('brandid') == $brand->brandid ? 'selected' : '' }}>{{ $brand->brandname }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Giá bán (VNĐ)</label>
            <input type="number" name="price" class="form-control" value="{{ old('price') }}" placeholder="Ví dụ: 150000" required>
            @error('price')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Trạng thái bán</label>
            <select name="status" class="form-select">
                <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Hiển thị & Mở bán</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Tạm ẩn</option>
            </select>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4">Lưu lại</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary px-4">Quay lại</a>
        </div>
    </form>
</div>
@endsection