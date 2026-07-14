<div class="admin-sidebar bg-dark text-white p-3 vh-100">

    <h4 class="mb-4">
        <i class="bi bi-speedometer2"></i>
        Admin Panel
    </h4>

    <ul class="nav flex-column">

        <li class="nav-item mb-2">
            <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-house-door"></i>
                Dashboard
            </a>
        </li>

        {{-- Menu Thả Xuống: Quản Lý Hệ Thống --}}
        <li class="nav-item">

            <a class="nav-link text-white"
               data-bs-toggle="collapse"
               href="#adminSystemMenu"
               role="button"
               aria-expanded="true">
                <i class="bi bi-gear-fill"></i>
                Quản lý hệ thống
                <i class="bi bi-chevron-down float-end"></i>
            </a>

            <div class="collapse show" id="adminSystemMenu">

                <ul class="nav flex-column ms-3 mt-1 gap-1">
                    <li class="nav-item">
                        <a class="nav-link text-white-50" href="{{ route('admin.categories.index') }}">
                            <i class="bi bi-tags-fill me-1"></i> Loại sản phẩm
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white-50" href="{{ route('admin.brands.index') }}">
                            <i class="bi bi-award-fill me-1"></i> Thương hiệu
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white-50" href="{{ route('admin.products.index') }}">
                            <i class="bi bi-box-seam-fill me-1"></i> Sản phẩm
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white-50" href="{{ route('admin.posts.index') }}">
                            <i class="bi bi-journal-text me-1"></i> Bài viết
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white-50" href="{{ route('admin.users.index') }}">
                            <i class="bi bi-people-fill me-1"></i> Người dùng
                        </a>
                    </li>
                </ul>

            </div>

        </li>

    </ul>

</div>