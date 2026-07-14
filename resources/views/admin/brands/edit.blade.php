@extends('admin.layouts.admin')
@section('title', 'Sửa thương hiệu')
@section('content')
<div class="card p-4 shadow-sm" style="max-width: 600px; margin: 0 auto;">
    <h3 class="mb-4 text-warning fw-bold">SỬA THƯƠNG HIỆU</h3>

    <x-admin.alert />

    <form action="{{ route('admin.brands.update', $brand->brandid) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label fw-bold">Tên thương hiệu</label>
            <input type="text" name="brandname" class="form-control" value="{{ old('brandname', $brand->brandname) }}">
            @error('brandname')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', $brand->slug) }}">
            @error('slug')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3 img-group">
            <label class="form-label fw-bold">Hình ảnh</label>
            <input type="file" name="img" class="form-control img-input">
            <div class="img-preview mt-2">
                @if ($brand->image)
                    <img src="{{ asset('storage/brands/' . $brand->image) }}" class="img-thumbnail" width="150">
                @endif
            </div>
            @error('img')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Mô tả thương hiệu</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $brand->description) }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold d-block">Trạng thái</label>
            <input type="radio" class="btn-check" name="status" id="active" value="1" {{ old('status', $brand->status) == 1 ? 'checked' : '' }}>
            <label class="btn btn-outline-success" for="active">Hiện</label>

            <input type="radio" class="btn-check" name="status" id="inactive" value="0" {{ old('status', $brand->status) == 0 ? 'checked' : '' }}>
            <label class="btn btn-outline-danger" for="inactive">Ẩn</label>
            @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-warning px-4 fw-bold">Cập nhật</button>
            <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary px-4">Hủy bỏ</a>
        </div>
    </form>
</div>
@endsection