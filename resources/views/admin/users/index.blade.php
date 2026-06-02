@extends('admin.layouts.admin')

@section('title', 'Quản lý Người Dùng')

@section('content')
<h2 class="mb-3">DANH SÁCH NGƯỜI DÙNG</h2>

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Ảnh đại diện</th>
            <th>Tên tài khoản</th>
            <th>Họ và tên</th>
            <th>Email</th>
            <th>Giới tính</th>
            <th>Vai trò</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            
            <td>
                @if($item->gender == 1)
                    <img src="{{ asset('images/avatar-male.png') }}" alt="Avatar" style="width: 45px; height: 45px; object-fit: cover; border-radius: 50%;">
                @elseif($item->gender == 2)
                    <img src="{{ asset('images/avatar-female.png') }}" alt="Avatar" style="width: 45px; height: 45px; object-fit: cover; border-radius: 50%;">
                @else
                    <img src="{{ asset('images/default.png') }}" alt="Avatar" style="width: 45px; height: 45px; object-fit: cover; border-radius: 50%;">
                @endif
            </td>
            
            <td class="fw-bold">{{ $item->username }}</td>
            
            <td>{{ $item->fullname }}</td>
            
            <td>{{ $item->email }}</td>
            
            <td>
                @if($item->gender == 1)
                    <span class="text-primary"><i class="bi bi-gender-male"></i> Nam</span>
                @elseif($item->gender == 2)
                    <span class="text-danger"><i class="bi bi-gender-female"></i> Nữ</span>
                @else
                    <span class="text-muted">Chưa rõ</span>
                @endif
            </td>
            
            <td>
                @if($item->role == 1)
                    <span class="badge bg-danger">Quản lý</span>
                @else
                    <span class="badge bg-info text-dark">Nhân viên</span>
                @endif
            </td>
            
            <td>
                @if($item->status == 1)
                    <span class="badge bg-success">Kích hoạt</span>
                @else
                    <span class="badge bg-secondary">Bị khóa</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection