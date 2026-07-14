@extends('admin.layouts.admin')
@section('title', 'Sửa Sản Phẩm')
@section('content')
<div class="card p-4 shadow-sm" style="max-width: 700px; margin: 0 auto;">
    <h3 class="mb-4 text-warning fw-bold">SỬA SẢN PHẨM</h3>

    <x-admin.alert />

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Tên sản phẩm</label>
            <input type="text" name="productname" class="form-control" value="{{ old('productname', $product->productname) }}">
            @error('productname')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', $product->slug) }}">
            @error('slug')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Loại sản phẩm</label>
                <select name="cateid" class="form-select">
                    <option value="">-- Chọn loại sản phẩm --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->cateid }}" {{ old('cateid', $product->cateid) == $category->cateid ? 'selected' : '' }}>
                            {{ $category->catename }}
                        </option>
                    @endforeach
                </select>
                @error('cateid')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Thương hiệu</label>
                <select name="brandid" class="form-select">
                    <option value="">-- Chọn thương hiệu --</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->brandid }}" {{ old('brandid', $product->brandid) == $brand->brandid ? 'selected' : '' }}>
                            {{ $brand->brandname }}
                        </option>
                    @endforeach
                </select>
                @error('brandid')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Giá gốc</label>
                <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}">
                @error('price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Giá khuyến mãi</label>
                <input type="number" name="pricediscount" class="form-control" value="{{ old('pricediscount', $product->pricediscount) }}">
                @error('pricediscount')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Mô tả sản phẩm</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3 img-group">
            <label class="form-label fw-bold">Hình ảnh chính</label>
            <input type="file" name="img" class="form-control img-input">
            <div class="img-preview mt-2">
                @if ($product->image)
                    <img src="{{ asset('storage/products/' . $product->image) }}" class="img-thumbnail" width="120">
                @endif
            </div>
            @error('img')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3 img-group">
            <label class="form-label fw-bold">Hình ảnh phụ</label>
            <input type="file" name="imgs[]" class="form-control img-input" multiple>
            <div class="img-preview mt-2 d-flex flex-wrap gap-2">
                @foreach ($product->images as $image)
                    <div class="position-relative sub-image-container" id="sub-image-{{ $image->id }}">
                        <img src="{{ asset('storage/products/' . $image->image) }}" class="img-thumbnail" width="100" style="height: 100px; object-fit: cover;">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 p-1 py-0 btn-delete-sub-image" data-id="{{ $image->id }}" title="Xóa ảnh này">
                            &times;
                        </button>
                    </div>
                @endforeach
            </div>
            @error('imgs')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            @error('imgs.*')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold d-block">Trạng thái</label>
            <input type="radio" class="btn-check" name="status" id="active" value="1" {{ old('status', $product->status) == 1 ? 'checked' : '' }}>
            <label class="btn btn-outline-success" for="active">Hiện</label>

            <input type="radio" class="btn-check" name="status" id="inactive" value="0" {{ old('status', $product->status) == 0 ? 'checked' : '' }}>
            <label class="btn btn-outline-danger" for="inactive">Ẩn</label>
            @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-warning px-4 fw-bold">Cập nhật</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary px-4">Quay lại</a>
        </div>
    </form>
</div>

@section('scripts')
<script>
    document.querySelectorAll('.btn-delete-sub-image').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Bạn có chắc chắn muốn xóa hình ảnh phụ này?')) {
                const imageId = this.getAttribute('data-id');
                const container = document.getElementById('sub-image-' + imageId);
                
                fetch(`/admin/products/images/${imageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        container.remove();
                    } else {
                        alert(data.message || 'Xóa ảnh thất bại.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Đã xảy ra lỗi khi xóa ảnh phụ.');
                });
            }
        });
    });
</script>
@endsection
@endsection