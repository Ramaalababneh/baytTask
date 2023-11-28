<aside class="left-sidebar sidebar-dark" id="left-sidebar">
    <div id="sidebar" class="sidebar sidebar-with-footer">
        <div class="app-brand">
            <a href="">
                <span class="brand-name" style="font-size: 17px">Bayt Task</span>
            </a>
        </div>
        <div class="sidebar-left" data-simplebar style="height: 100%;">
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <li>
                    <a class="sidenav-item-link" href="{{ url('dashboard') }}">
                        <i class="mdi mdi-briefcase-account-outline"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a class="sidenav-item-link" href="{{ route('users.index') }}">
                        <i class="mdi mdi-account-group"></i>
                        <span class="nav-text">Users</span>
                    </a>
                </li>

                <li>
                    <a class="sidenav-item-link" href="{{ route('students.index') }}">
                        <i class="mdi mdi-account-group"></i>
                        <span class="nav-text">Students</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</aside>
