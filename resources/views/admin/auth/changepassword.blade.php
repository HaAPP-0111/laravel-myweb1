@extends('admin.layouts.admin')
@section('title', 'Đổi mật khẩu')
@section('content')
<div class="card p-4 shadow-sm" style="max-width: 600px; margin: 0 auto;">
    <h3 class="mb-4 text-primary fw-bold">ĐỔI MẬT KHẨU</h3>

    <x-admin.alert />

    <form action="{{ route('admin.changepassword.post') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="old_password" class="form-label fw-bold">Mật khẩu cũ</label>
            <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Nhập mật khẩu cũ">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-bold">Mật khẩu mới</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu mới">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label fw-bold">Xác nhận mật khẩu mới</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu mới">
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Đổi mật khẩu</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary px-4">Hủy bỏ</a>
        </div>
    </form>
</div>
@endsection
