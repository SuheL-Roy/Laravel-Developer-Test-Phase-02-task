<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="../dashboard/index.html" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                <img src="../assets/images/logo-dark.svg" alt="logo image" class="logo-lg" />
                <span class="badge bg-brand-color-2 rounded-pill ms-2 theme-version">v1.0</span>
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">



                <li class="pc-item">
                    <a href="{{ route('home') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-projector-screen-chart"></i>
                        </span>
                        <span class="pc-mtext">Post List</span>
                    </a>
                </li>

                <li class="pc-item">
                    <a href="{{ route('admin.create_post') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-projector-screen-chart"></i>
                        </span>
                        <span class="pc-mtext">Create Post</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('category.create_category') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-projector-screen-chart"></i>
                        </span>
                        <span class="pc-mtext">Category List</span>
                    </a>
                </li>

                <li class="pc-item">
                    <a href="{{ route('blog') }}" target="__blank" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-projector-screen-chart"></i>
                        </span>
                        <span class="pc-mtext">Public Blog List</span>
                    </a>
                </li>








            </ul>

        </div>
        <div class="card pc-user-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <img src="../assets/images/user/avatar-1.jpg" alt="user-image"
                            class="user-avtar wid-45 rounded-circle" />
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="dropdown">
                            <a href="#" class="arrow-none dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false" data-bs-offset="0,20">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 me-2">
                                        <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                                        {{-- <small>Administrator</small> --}}
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="btn btn-icon btn-link-secondary avtar">
                                            <i class="ph-duotone ph-windows-logo"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu">
                                <ul>

                                    <li>
                                        <a class="pc-user-links" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="ph-duotone ph-power"></i>
                                            <span>Logout</span>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
