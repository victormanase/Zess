<div class="horizontal-menu">
    <nav class="navbar top-navbar">
        <div class="container">
            <div class="navbar-content">
                <a href="{{ url('/') }}" class="navbar-brand">
                    {{ config('app.name') }}
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown nav-profile">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('assets/images/avatar.png') }}" alt="profile">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="profileDropdown">
                            <div class="dropdown-header d-flex flex-column align-items-center">
                                <div class="figure mb-3">
                                    <img src="{{ asset('assets/images/avatar.png') }}" alt="">
                                </div>
                                <div class="info text-center">
                                    <p class="name font-weight-bold mb-0">{{ Auth::user()->name ?? 'John Doe' }}</p>
                                    <p class="email text-muted mb-3">{{ Auth::user()->email ?? 'johndoe@gmail.com' }}
                                    </p>
                                </div>
                            </div>
                            <div class="dropdown-body">
                                <ul class="profile-nav p-0 pt-3">
                                    <li class="nav-item">
                                        <a href="javascript:;" class="nav-link">
                                            <i data-feather="edit"></i>
                                            <span>Edit Profile</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button href="{{ url('logout') }}" class="nav-link btn-link btn">
                                                <i data-feather="log-out"></i>
                                                <span>Log Out</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="horizontal-menu-toggle">
                    <i data-feather="menu"></i>
                </button>
            </div>
        </div>
    </nav>
    <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation  justify-content-start">
                <li class="nav-item {{ active_class(['/']) }}">
                    <a class="nav-link" href="{{ url('/') }}">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li
                    class="nav-item {{ active_class(['users/*']) }}">
                    <a href="#" class="nav-link">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="menu-title">Users</span>
                        <i class="link-arrow"></i>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <li class="nav-item">
                                <a class="nav-link {{ active_class([]) }}"
                                    href="{{ route("users.doctors.index") }}">Doctors</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ active_class([]) }}"
                                    href="{{ route("users.clients.index") }}">Clients</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ active_class([]) }}"
                                    href="{{ route("users.index") }}">Users</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li
                    class="nav-item {{ active_class(['manage/*','users/patients/*']) }}">
                    <a href="#" class="nav-link">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="menu-title">Manage</span>
                        <i class="link-arrow"></i>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <li class="nav-item">
                                <a class="nav-link {{ active_class(["users/patients/*"]) }}"
                                    href="{{ route("manage.patients.index") }}">Patients</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ active_class(["manage/services*",]) }}"
                                    href="{{ url('/manage/services') }}">Services</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link {{ active_class([]) }}"
                                    href="{{ url('/manage/invoices') }}">Invoices</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link {{ active_class([]) }}"
                                    href="{{ url('/manage/roles') }}">Roles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ active_class([]) }}"
                                    href="{{ url('/manage/expenses') }}">Expenses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ active_class([]) }}"
                                    href="{{ route("manage.expense-categories.index") }}">Expense Categories</a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- <li
                    class="nav-item {{ active_class(['reports/*']) }}">
                    <a href="#" class="nav-link">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="menu-title">Reports</span>
                        <i class="link-arrow"></i>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <li class="nav-item">
                                <a class="nav-link {{ active_class([]) }}"
                                    href="{{ url('reports/expense-report') }}">Expense Report</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                <li
                    class="nav-item {{ active_class(['settings/*']) }}">
                    <a href="#" class="nav-link">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="menu-title">Settings</span>
                        <i class="link-arrow"></i>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <li class="nav-item">
                                <a class="nav-link {{ active_class([]) }}"
                                    href="{{ url('/settings/mail') }}">Mail</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ active_class([]) }}"
                                    href="{{ url('/settings/details') }}">Details</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
