{{-- Thừa kế layout từ view admin.blade.php --}}
@extends('admin.layouts.admin')

{{-- Gán nội dung cho vùng section 'title' --}}
@section('title', 'Loại Sản Phẩm')

{{-- Gán nội dung cho vùng section 'content' --}}
@section('content')
<h2 class="mb-3">DANH SÁCH LOẠI SẢN PHẨM</h2>

<a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">
    + Thêm mới
</a>

<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>Mã loại</th>
            <th>Tên loại</th>
            <th>Slug</th>
            <th>Trạng thái</th>
            <th class="text-center" style="width: 120px;">Chức năng</th> {{-- Thêm cột Tiêu đề Chức năng --}}
        </tr>
    </thead>
    <tbody>
        @foreach($list as $item)
        <tr>
            <td>{{ $item->cateid }}</td>
            <td>{{ $item->catename }}</td>
            <td>{{ $item->slug }}</td>
            <td>
                @if($item->status == 1)
                    <span class="badge bg-success">Hiển thị</span>
                @else
                    <span class="badge bg-danger">Ẩn</span>
                @endif
            </td>
            <td class="text-center">
                {{-- Form xử lý xóa loại sản phẩm dựa trên gợi ý từ tài liệu --}}
                <form action="{{ route('admin.categories.destroy', $item->cateid) }}" 
                      method="POST" 
                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa loại sản phẩm này không?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i> Xóa
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection