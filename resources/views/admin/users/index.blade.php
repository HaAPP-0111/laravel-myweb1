<<<<<<< HEAD
@extends('admin.layouts.admin')
@section('title', 'Quản lý Người Dùng')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>DANH SÁCH NGƯỜI DÙNG</h2>
    <a href="{{ route('admin.users.create') }}" class="btn btn-success">+ Thêm mới</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
=======
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
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
<<<<<<< HEAD
            <th>STT</th>
            <th>Mã số</th>
            <th>Tài khoản</th>
            <th>Họ và tên</th>
            <th>Email</th>
            <th>Trạng thái</th>
            <th class="text-center" style="width: 100px;">Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $index => $item)
        <tr>
            <td>{{ ($list->currentPage() - 1) * $list->perPage() + $index + 1 }}</td>
            <td>{{ $item->id }}</td>
            <td>{{ $item->username }}</td>
            <td>{{ $item->fullname }}</td>
            <td>{{ $item->email }}</td>
            <td>
                <span class="badge {{ $item->status == 1 ? 'bg-success' : 'bg-danger' }}">
                    {{ $item->status == 1 ? 'Hoạt động' : 'Khóa' }}
                </span>
            </td>
            <td class="text-center">
                <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">
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
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
