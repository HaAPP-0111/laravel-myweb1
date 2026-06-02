@extends('admin.layouts.admin')

@section('title', 'Thêm Loại Sản Phẩm')

@section('content')
<div class="card p-4 shadow-sm" style="max-width: 600px; margin: 0 auto;">
    <h3 class="mb-4 text-primary">THÊM LOẠI SẢN PHẨM MỚI</h3>
    
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold">Tên loại sản phẩm</label>
            <input type="text" name="catename" class="form-control" placeholder="Nhập tên loại..." required>
        </div>
        
        <div class="mb-3">
            <label class="form-label fw-bold">Slug (Không bắt buộc)</label>
            <input type="text" name="slug" class="form-control" placeholder="Để trống tự động tạo slug...">
        </div>
        
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4">Lưu lại</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary px-4">Quay lại</a>
        </div>
    </form>
</div>
@endsection