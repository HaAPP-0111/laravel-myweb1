{{-- Thừa kế layout từ view admin.blade.php --}}
@extends('admin.layouts.admin')

{{-- Gán nội dung cho vùng section 'title' --}}
@section('title', 'Thêm loại sản phẩm')

{{-- Gán nội dung cho vùng section 'content' --}}
@section('content')
<h2 class="mb-3">THÊM LOẠI SẢN PHẨM</h2>

<form action="{{ route('admin.categories.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Tên loại sản phẩm</label>
        <input type="text" name="catename" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
