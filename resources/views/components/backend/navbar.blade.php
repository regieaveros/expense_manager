<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item align-self-baseline">
            <h6 class="px-4">Welcome to Expense Manager</h6>
        </li>
        <li class="nav-item dropdown align-self-baseline">
            <button class="btn btn-link mr-2" data-toggle="modal" data-target="#modal_profile">Profile</button>
        </li>
        <li class="nav-item dropdown align-self-baseline">
            <a class="btn btn-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>