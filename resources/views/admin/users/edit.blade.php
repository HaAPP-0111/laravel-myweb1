@extends('admin.layouts.admin')
@section('title', 'Sửa Người Dùng')
@section('content')
<div class="card p-4 shadow-sm" style="max-width: 600px; margin: 0 auto;">
    <h3 class="mb-4 text-primary text-uppercase fw-bold">CHỈNH SỬA TÀI KHOẢN</h3>

    {{-- Hiện thị tất cả lỗi Validation --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label fw-bold">Tên tài khoản (Username)</label>
            <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" placeholder="Nhập tên tài khoản...">
            @error('username')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Họ và tên (Fullname)</label>
            <input type="text" name="fullname" class="form-control" value="{{ old('fullname', $user->fullname) }}" placeholder="Nhập họ và tên...">
            @error('fullname')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Số điện thoại (Phone)</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" placeholder="Nhập số điện thoại...">
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Địa chỉ Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" placeholder="name@example.com">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Mật khẩu mới (Tùy chọn)</label>
            <input type="password" name="password" class="form-control" placeholder="Để trống nếu không muốn đổi mật khẩu...">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Giới tính</label>
            <select name="gender" class="form-select">
                <option value="1" {{ old('gender', $user->gender) == '1' ? 'selected' : '' }}>Nam</option>
                <option value="2" {{ old('gender', $user->gender) == '2' ? 'selected' : '' }}>Nữ</option>
                <option value="0" {{ old('gender', $user->gender) == '0' ? 'selected' : '' }}>Khác</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Vai trò</label>
            <select name="role" class="form-select">
                <option value="1" {{ old('role', $user->role) == '1' ? 'selected' : '' }}>Quản lý</option>
                <option value="2" {{ old('role', $user->role) == '2' ? 'selected' : '' }}>Nhân viên</option>
            </select>
            @error('role')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Trạng thái tài khoản</label>
            <select name="status" class="form-select">
                <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>Kích hoạt (Hoạt động)</option>
                <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : '' }}>Tạm khóa</option>
            </select>
            @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4">Cập nhật</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary px-4">Quay lại</a>
        </div>
    </form>
</div>
@endsection
