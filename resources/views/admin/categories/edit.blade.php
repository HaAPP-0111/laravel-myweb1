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