@extends('admin.layouts.admin')
@section('title', 'Trash - Bài viết')
@section('content')
<h2 class="mb-3">DANH SÁCH BÀI VIẾT - ĐANG CHỜ XÓA</h2>
<x-admin.alert />
<a href="{{ route('admin.posts.index') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i> Quay lại danh sách
</a>
<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>Mã bài viết</th>
            <th>Hình ảnh</th>
            <th>Tiêu đề bài viết</th>
            <th>Trạng thái</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>
                @php
                    $imageUrl = ($item->image && file_exists(public_path('images/' . $item->image)))
                        ? asset('images/' . $item->image)
                        : asset('images/1.jpg');
                @endphp
                <img src="{{ $imageUrl }}" alt="Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
            </td>
            <td>{{ $item->title }}</td>
            <td>
                @if ($item->status == 1)
                    <span class="badge bg-success">Công khai</span>
                @else
                    <span class="badge bg-danger">Nháp</span>
                @endif
            </td>
            <td>
                <form action="{{ route('admin.posts.restore', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-success btn-sm">Khôi phục</button>
                </form>
                <form action="{{ route('admin.posts.forceDelete', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn bài viết này?')" class="btn btn-danger btn-sm">
                        Xóa
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
        @if($list->isEmpty())
        <tr>
            <td colspan="5" class="text-center text-muted">Thùng rác trống.</td>
        </tr>
        @endif
    </tbody>
</table>
<div class="d-flex justify-content-center mt-3">
    {{ $list->links() }}
</div>
@endsection
