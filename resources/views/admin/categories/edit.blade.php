<<<<<<< HEAD
@extends('admin.layouts.admin')

@section('title', 'Cập Nhật Loại Sản Phẩm')

@section('content')
<div class="card p-4 shadow-sm" style="max-width: 600px; margin: 0 auto;">
    <h3 class="mb-4 text-warning text-uppercase fw-bold">Cập Nhật Loại Sản Phẩm</h3>
    
    <form action="{{ route('admin.categories.update', $category->cateid) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label fw-bold">Tên loại sản phẩm</label>
            <input type="text" 
                   name="catename" 
                   class="form-control" 
                   value="{{ old('catename', $category->catename) }}" 
                   placeholder="Nhập tên loại..." 
                   required>
            @error('catename')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label fw-bold">Slug (Đường dẫn thân thiện)</label>
            <input type="text" 
                   name="slug" 
                   class="form-control" 
                   value="{{ old('slug', $category->slug) }}" 
                   placeholder="Để trống tự động tạo lại slug...">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Trạng thái hiển thị</label>
            <select name="status" class="form-select">
                <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Hiển thị (Bật)</option>
                <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Ẩn (Tắt)</option>
            </select>
        </div>
        
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-warning px-4 text-white fw-bold">Cập nhật</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary px-4">Quay lại</a>
        </div>
    </form>
</div>
@endsection
=======
﻿{{-- Thừa kế layout từ view admin.blade.php --}}
@extends('admin.layouts.admin')

{{-- Gán nội dung cho vùng section 'title' --}}
@section('title', 'Chỉnh sửa loại sản phẩm')

{{-- Gán nội dung cho vùng section 'content' --}}
@section('content')
<h2 class="mb-3">CHỈNH SỬA LOẠI SẢN PHẨM</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Vui lòng sửa các lỗi sau:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.categories.update', $category->cateid) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Tên loại sản phẩm</label>
        <input type="text" name="catename" class="form-control @error('catename') is-invalid @enderror" value="{{ old('catename', $category->catename) }}" required>
        @error('catename')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $category->slug) }}" required>
        @error('slug')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Sắp xếp (sort order)</label>
        <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $category->sort_order) }}">
        @error('sort_order')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Mô tả</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $category->description) }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Trạng thái</label>
        <select name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Hoạt động</option>
            <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Không hoạt động</option>
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
