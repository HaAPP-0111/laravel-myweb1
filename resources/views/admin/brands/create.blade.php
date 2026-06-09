@extends('admin.layouts.admin')
@section('title', 'Thêm Thương Hiệu')
@section('content')
<div class="card p-4 shadow-sm" style="max-width: 600px; margin: 0 auto;">
    <h3 class="mb-4 text-primary text-uppercase fw-bold">THÊM THƯƠNG HIỆU MỚI</h3>
    <form action="{{ route('admin.brands.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold">Tên thương hiệu</label>
            <input type="text" name="brandname" class="form-control" value="{{ old('brandname') }}" placeholder="Nhập tên thương hiệu..." required>
            @error('brandname')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Slug (Không bắt buộc)</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="Để trống tự động tạo slug...">
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Trạng thái hiển thị</label>
            <select name="status" class="form-select">
                <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Hiển thị (Bật)</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Ẩn (Tắt)</option>
            </select>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4">Lưu lại</button>
            <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary px-4">Quay lại</a>
        </div>
    </form>
</div>
@endsection