{{-- Thừa kế layout từ view admin.blade.php --}}
@extends('admin.layouts.admin')

{{-- Gán nội dung cho vùng section 'title' --}}
@section('title', 'Người dùng')

{{-- Gán nội dung cho vùng section 'content' --}}
@section('content')
<h2 class="mb-3">DANH SÁCH NGƯỜI DÙNG</h2>

@php
    $defaultImage = asset('default.png');
@endphp

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th style="width: 70px">STT</th>
            <th style="width: 90px">Ảnh</th>
            <th style="width: 90px">ID</th>
            <th>Họ tên</th>
            <th>Email</th>
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
                    <img src="{{ $imageUrl }}" alt="{{ $item->name }}" style="width: 60px; height: 60px; object-fit: cover;" class="rounded-circle border" />
                </td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
