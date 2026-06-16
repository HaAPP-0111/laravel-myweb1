<<<<<<< HEAD
@extends('admin.layouts.admin')
@section('title', 'Quản lý Thương Hiệu')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>DANH SÁCH THƯƠNG HIỆU</h2>
    <a href="{{ route('admin.brands.create') }}" class="btn btn-success">+ Thêm mới</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
=======
{{-- Thừa kế layout từ view admin.blade.php --}}
@extends('admin.layouts.admin')

{{-- Gán nội dung cho vùng section 'title' --}}
@section('title', 'Thương hiệu')

{{-- Gán nội dung cho vùng section 'content' --}}
@section('content')
<h2 class="mb-3">DANH SÁCH THƯƠNG HIỆU</h2>

@php
    $defaultImage = asset('default.png');
@endphp
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
<<<<<<< HEAD
            <th>STT</th>
            <th>Mã thương hiệu</th>
            <th>Hình ảnh</th>
            <th>Tên thương hiệu</th>
            <th>Slug</th>
            <th>Trạng thái</th>
            <th class="text-center" style="width: 100px;">Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $index => $item)
        <tr>
            <td>{{ ($list->currentPage() - 1) * $list->perPage() + $index + 1 }}</td>
            <td>{{ $item->brandid }}</td>
            <td>
                <img src="{{ asset('images/' . ($item->image ?? 'R.jpg')) }}" alt="Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
            </td>
            <td>{{ $item->brandname }}</td>
            <td>{{ $item->slug }}</td>
            <td>
                <span class="badge {{ $item->status == 1 ? 'bg-success' : 'bg-danger' }}">
                    {{ $item->status == 1 ? 'Hiển thị' : 'Ẩn' }}
                </span>
            </td>
            <td class="text-center">
                <form action="{{ route('admin.brands.destroy', $item->brandid) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center mt-3">
    {{ $list->links() }}
</div>
@endsection
=======
            <th style="width: 70px">STT</th>
            <th style="width: 90px">Ảnh</th>
            <th>Mã</th>
            <th>Tên thương hiệu</th>
            <th>Slug</th>
            <th style="width: 140px">Trạng thái</th>
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
                    <img src="{{ $imageUrl }}" alt="{{ $item->brandname }}" style="width: 60px; height: 60px; object-fit: cover;" class="rounded border" />
                </td>
                <td>{{ $item->brandid }}</td>
                <td>{{ $item->brandname }}</td>
                <td>{{ $item->slug }}</td>
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
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
