@extends('admin.layouts.admin')
@section('title', 'Danh sách bài viết')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>DANH SÁCH BÀI VIẾT</h2>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Thêm mới
    </a>
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
                <img src="{{ asset('images/posts/' . ($item->image ?? 'default.png')) }}" style="width: 60px; height: 45px; object-fit: cover; border-radius: 4px;">
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