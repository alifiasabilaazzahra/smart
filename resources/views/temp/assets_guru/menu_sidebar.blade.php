<aside class="menu-sidebar2">
    <div class="logo">
        <a href="#" class="navbar-brand text-white">
            <img src="/assets/img/logo/logo.png" alt="Cool Admin" class="navbar-toggler-icon" />
            SmarT
        </a>
    </div>
    <div class="menu-sidebar2__content js-scrollbar1">
        <div class="account2">
            <!-- <div class="image img-cir img-120 bg-success text-white text-center">
                <div class="row h-100">
                    <div class="col align-self-center h1">
                        <i class="zmdi zmdi-account-o"></i>
                    </div>
                </div>
            </div> -->
            <h4 class="name text-center">
                {{Auth::user()->account->name}}
            </h4>
            <div class="text-muted">
                Mengajar : 
                @if (count(Auth::user()->account->subjects) > 0)
                @foreach(Auth::user()->account->subjects as $k)
                - {{ $k->subject_name }}
                @endforeach
                @else
                -
                @endif
            </div>
            <a href="/logout"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        </div>
        <nav class="navbar-sidebar2">
            <ul class="list-unstyled navbar__list">
                <li class="dashboard">
                    <a href="/guru">
                        <i class="fas fa-chart-bar"></i> Dashboard</a>
                    <!-- <span class="inbox-num">3</span> -->
                </li>
                <li class="materi">
                    <a href="/guru/materi">
                        <i class="fas fa-book"></i>Materi</a>
                </li>
                <li class="tugas">
                    <a href="/guru/list_tugas">
                        <i class="fas fa-book"></i> Tugas</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
