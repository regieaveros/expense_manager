<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-panel mt-3 mb-3 d-flex flex-column">
            <div class="image mb-1">
                <img src="{{ asset('img/user.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <p class="info text-white">
                @if(Auth::user()->role_id == 1)
                    {{ Auth::user()->name }}&#40;Administrator&#41;
                @elseif(Auth::user()->role_id == 40)
                    {{ Auth::user()->name }}&#40;User&#41;
                @else
                    {{ Auth::user()->name }}&#40;Other&#41;
                @endif
            </p>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if(Auth::user()->role_id == 1)
                    <li class="nav-header nav-header-layout">User Management</li>
                    <li class="nav-item">
                        <a href="{{ route('roles') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-tag"></i>
                            <p>Roles</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Users</p>
                        </a>
                    </li>
                @endif
                <li class="nav-header nav-header-layout">Expense Management</li>
                @if(Auth::user()->role_id == 1)
                    <li class="nav-item">
                        <a href="{{ route('expense-categories') }}" class="nav-link">
                            <i class="nav-icon fas fa-list-ul"></i>
                            <p>Expense Categories</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('expenses') }}" class="nav-link">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>Expenses</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>