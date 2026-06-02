@extends('admin.layouts.admin')

@section('title', 'Quản lý Bài viết')

@section('content')
<h2 class="mb-3">DANH SÁCH BÀI VIẾT</h2>

@php
    $defaultImage = asset('images/default.png');
@endphp

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th style="width: 70px">STT</th>
            <th style="width: 90px">Ảnh</th>
            <th>Tiêu đề bài viết</th>
            <th>Slug</th>
            <th>Tác giả</th>
            <th style="width: 140px">Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $item)
            @php
                $candidate = $item->image ?? null;
                $imageUrl = ($candidate && file_exists(public_path('images/' . $candidate)))
                    ? asset('images/' . $candidate)
                    : $defaultImage;
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <img src="{{ $imageUrl }}" alt="{{ $item->title }}" style="width: 60px; height: 60px; object-fit: cover;" class="rounded border" />
                </td>
                <td class="fw-bold text-dark">{{ $item->title }}</td>
                <td><small class="text-muted">{{ $item->slug }}</small></td>
                <td><span class="badge bg-secondary">{{ $item->author_name }}</span></td>
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