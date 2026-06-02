{{-- Thừa kế layout từ view admin.blade.php --}}
@extends('admin.layouts.admin')

{{-- Gán nội dung cho vùng section 'title' --}}
@section('title', 'Bài viết')

{{-- Gán nội dung cho vùng section 'content' --}}
@section('content')
<h2 class="mb-3">DANH SÁCH BÀI VIẾT</h2>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
@endif

@php
    $defaultImage = asset('default.png');
@endphp

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th style="width:70px">STT</th>
            <th style="width:90px">Ảnh</th>
            <th style="width:90px">ID</th>
            <th>Tiêu đề</th>
            <th>Slug</th>
            <th style="width:180px">Tác giả</th>
            <th style="width:140px">Ngày tạo</th>
            <th style="width:120px">Trạng thái</th>
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
                    <img src="{{ $imageUrl }}" alt="{{ $item->title }}" style="width:60px;height:60px;object-fit:cover;" class="rounded border" />
                </td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->slug }}</td>
                <td>{{ $item->user_name ?? '' }}</td>
                <td>
                    {{ $item->created_at ? \Illuminate\Support\Carbon::parse($item->created_at)->format('Y-m-d') : '' }}
                </td>
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
