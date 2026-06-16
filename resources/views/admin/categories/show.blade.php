{{-- Thừa kế layout từ view admin.blade.php --}}
@extends('admin.layouts.admin')

{{-- Gán nội dung cho vùng section 'title' --}}
@section('title', 'Chi tiết danh mục')

{{-- Gán nội dung cho vùng section 'content' --}}
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="mb-0">{{ $category->catename }}</h2>
            <p class="text-muted mb-0">{{ $category->slug }}</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Thông tin danh mục</h5>
                    <p><strong>Trạng thái:</strong> {!! $category->status === 1 ? '<span class="badge bg-success">Hoạt động</span>' : '<span class="badge bg-danger">Ẩn</span>' !!}</p>
                    <p><strong>Sort order:</strong> {{ $category->sort_order }}</p>
                    <p><strong>Số sản phẩm:</strong> {{ $category->products->count() }}</p>
                    <p><strong>Mô tả:</strong></p>
                    <p>{{ $category->description ?? 'Chưa có mô tả' }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sản phẩm thuộc danh mục</h5>
                    @if($category->products->isEmpty())
                        <div class="alert alert-info">Chưa có sản phẩm nào trong danh mục này.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width:60px">STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Slug</th>
                                        <th style="width:120px">Giá</th>
                                        <th style="width:120px">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category->products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->productname }}</td>
                                        <td>{{ $product->slug }}</td>
                                        <td>{{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td>
                                            @if($product->status == 1)
                                                <span class="badge bg-success">Hiển thị</span>
                                            @else
                                                <span class="badge bg-danger">Ẩn</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
