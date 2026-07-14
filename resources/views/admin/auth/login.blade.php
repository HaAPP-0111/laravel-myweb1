<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập hệ thống</title>
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
        .login-card {
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
                <div class="card login-card shadow-2xl p-4">
                    <form action="{{ route('admin.login.post') }}" method="POST">
                        @csrf
                        <h2 class="text-center mb-4 text-primary fw-bold">ĐĂNG NHẬP HỆ THỐNG</h2>
                        
                        {{-- hiển thị thông báo lỗi (nếu có) --}}
                        <x-admin.alert></x-admin.alert>

                        <div class="mb-3">
                            <label for="f-username" class="form-label fw-bold">Tên đăng nhập (Username)</label>
                            <input type="text" class="form-control" id="f-username" placeholder="Nhập username"
                                   name="username" value="{{ old('username') }}">
                        </div>

                        <div class="mb-3">
                            <label for="f-password" class="form-label fw-bold">Mật khẩu</label>
                            <input type="password" class="form-control" id="f-password"
                                   placeholder="Nhập mật khẩu" name="password"
                                   value="{{ old('password') }}">
                        </div>

                        <div class="form-check mb-3">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="remember"> Ghi nhớ đăng nhập
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">Đăng nhập</button>
                        <div class="text-center">
                            <a href="{{ route('admin.forgotpass') }}" class="text-decoration-none text-muted">Quên mật khẩu?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
