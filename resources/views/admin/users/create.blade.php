@extends('admin.layouts.admin')
@section('title', 'Thêm Người Dùng')
@section('content')
<div class="card p-4 shadow-sm" style="max-width: 600px; margin: 0 auto;">
    <h3 class="mb-4 text-primary text-uppercase fw-bold">THÊM TÀI KHOẢN MỚI</h3>

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

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold">Tên tài khoản (Username)</label>
            <input type="text" name="username" class="form-control" value="{{ old('username') }}" placeholder="Nhập tên tài khoản...">
            @error('username')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Họ và tên (Fullname)</label>
            <input type="text" name="fullname" class="form-control" value="{{ old('fullname') }}" placeholder="Nhập họ và tên...">
            @error('fullname')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Số điện thoại (Phone)</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Nhập số điện thoại...">
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Địa chỉ Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="name@example.com">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Mật khẩu</label>
            <input type="password" name="password" class="form-control" placeholder="Tối thiểu 6 ký tự...">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Giới tính</label>
            <select name="gender" class="form-select">
                <option value="1" {{ old('gender', '1') == '1' ? 'selected' : '' }}>Nam</option>
                <option value="2" {{ old('gender') == '2' ? 'selected' : '' }}>Nữ</option>
                <option value="0" {{ old('gender') == '0' ? 'selected' : '' }}>Khác</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Vai trò</label>
            <select name="role" class="form-select">
                <option value="1" {{ old('role', '1') == '1' ? 'selected' : '' }}>Quản lý</option>
                <option value="2" {{ old('role') == '2' ? 'selected' : '' }}>Nhân viên</option>
            </select>
            @error('role')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Trạng thái tài khoản</label>
            <select name="status" class="form-select">
                <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Kích hoạt (Hoạt động)</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Tạm khóa</option>
            </select>
            @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4">Lưu lại</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary px-4">Quay lại</a>
        </div>
    </form>
</div>
@endsection