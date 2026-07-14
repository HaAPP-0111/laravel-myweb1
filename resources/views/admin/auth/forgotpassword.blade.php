<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Quên mật khẩu</title>
{{-- CDN Bootstrap CSS --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .forgot-card {
        border: none;
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
    }
</style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card forgot-card shadow-2xl p-4">
                <form action="{{ route('admin.forgotpass.post') }}" method="POST">
                    @csrf
                    <h2 class="text-center mb-4 text-primary fw-bold">QUÊN MẬT KHẨU</h2>
                    <x-admin.alert></x-admin.alert>
                    <div class="mb-3">
                        <label for="f-email" class="form-label fw-bold">Email</label>
                        <input type="text" class="form-control" id="f-email" placeholder="Nhập email của bạn"
                               name="email" value="{{ old('email') }}">
                    </div>
                    <div class="mb-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">Gửi</button>
                        <a href="{{ route('admin.login') }}" class="btn btn-warning">Đăng nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
