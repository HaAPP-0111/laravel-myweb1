<nav class="navbar navbar-light bg-light admin-header">
    <div class="container-fluid">
        <span class="navbar-brand">Admin Panel</span>
        <div class="d-flex align-items-center gap-3 ms-auto">
            @if(Auth::check())
                <span>Xin chào <strong>{{ Auth::user()->fullname }}</strong></span>
                <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 text-decoration-none text-danger fw-bold ms-2">
                        Đăng xuất
                    </button>
                </form>
            @endif
        </div>
    </div>
</nav>