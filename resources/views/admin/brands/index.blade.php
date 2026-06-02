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

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
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
