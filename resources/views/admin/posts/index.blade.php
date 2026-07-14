@extends('admin.layouts.admin')
@section('title', 'Danh sách bài viết')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>DANH SÁCH BÀI VIẾT</h2>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Thêm mới
        </a>
        <a href="{{ route('admin.posts.trash') }}" class="btn btn-danger">
            <i class="bi bi-trash"></i> Thùng rác
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Hình ảnh</th>
            <th>Tiêu đề bài viết</th>
            <th>Tác giả</th>
            <th>Trạng thái</th>
            <th>Ngày tạo</th>
            <th class="text-center" style="width: 120px;">Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $index => $item)
        <tr>
            <td>{{ ($list->currentPage() - 1) * $list->perPage() + $index + 1 }}</td>
            <td>
                @php
                    $imageUrl = ($item->image && file_exists(public_path('images/' . $item->image)))
                        ? asset('images/' . $item->image)
                        : asset('images/1.jpg');
                @endphp
                <img src="{{ $imageUrl }}" alt="Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
            </td>
            <td>
                <strong>{{ $item->title }}</strong>
                <div class="small text-muted">{{ $item->slug }}</div>
            </td>
            <td>{{ $item->author_name }}</td>
            <td>
                <span class="badge {{ $item->status == 1 ? 'bg-success' : 'bg-danger' }}">
                    {{ $item->status == 1 ? 'Công khai' : 'Nháp' }}
                </span>
            </td>
            <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
            <td class="text-center">
                <div class="d-flex gap-1 justify-content-center">
                    <a href="{{ route('admin.posts.edit', $item->id) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <form action="{{ route('admin.posts.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center mt-3">
    {{ $list->links() }}
</div>
@endsection