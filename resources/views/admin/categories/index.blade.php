{{-- Thừa kế layout từ view admin.blade.php --}}
@extends('admin.layouts.admin')

{{-- Gán nội dung cho vùng section 'title' --}}
@section('title', 'Loại Sản Phẩm')

{{-- Gán nội dung cho vùng section 'content' --}}
@section('content')
<h2 class="mb-3">DANH SÁCH LOẠI SẢN PHẨM</h2>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">
    <i class="bi bi-plus-circle me-1"></i> Thêm mới
</a>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th class="text-center" style="width: 100px;">Mã loại</th>
                <th>Tên loại</th>
                <th>Slug</th>
                <th class="text-center" style="width: 120px;">Số sản phẩm</th>
                <th class="text-center" style="width: 130px;">Trạng thái</th>
                <th class="text-center" style="width: 260px;">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @forelse($list as $item)
            <tr>
                <td class="text-center">{{ $item->cateid }}</td>
                <td>{{ $item->catename }}</td>
                <td><code class="text-muted">{{ $item->slug }}</code></td>
                <td class="text-center">{{ $item->products_count }}</td>
                <td class="text-center">
                    @if($item->status == 1)
                        <span class="badge bg-success">Hiển thị</span>
                    @else
                        <span class="badge bg-danger">Ẩn</span>
                    @endif
                </td>
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.categories.show', $item->cateid) }}" class="btn btn-info btn-sm px-2">
                            <i class="bi bi-box-seam"></i> Sản phẩm
                        </a>
                        <a href="{{ route('admin.categories.edit', $item->cateid) }}" class="btn btn-primary btn-sm px-2">
                            <i class="bi bi-pencil-square"></i> Sửa
                        </a>
                        <form action="{{ route('admin.categories.destroy', $item->cateid) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa loại sản phẩm này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm px-2">
                                <i class="bi bi-trash-fill"></i> Xóa
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted py-3">Không có loại sản phẩm nào.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $list->links() }}
</div>
@endsection
