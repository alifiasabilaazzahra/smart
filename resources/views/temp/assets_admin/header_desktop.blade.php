<header class="header-desktop2">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap2">
                <div class="logo d-block d-lg-none">
                    <a href="#" class="navbar-brand text-white">
                        <img src="/assets/img/logo/logo.png" alt="Cool Admin" class="navbar-toggler-icon" />SmarT
                    </a>
                </div>
                <div class="header-button2">
                    <div class="header-button-item mr-0 js-sidebar-btn d-lg-none">
                        <i class="zmdi zmdi-menu"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
    <div class="menu-sidebar2__content js-scrollbar2">
        <div class="account2">
            <div class="image img-cir img-120 bg-success text-white text-center">
                <div class="row h-100">
                    <div class="col align-self-center h1">
                        <i class="zmdi zmdi-account-o"></i>
                    </div>
                </div>
            </div>
            <h4 class="name">Admin</h4>
            <a href="/logout"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        </div>
        <nav class="navbar-sidebar2">
            <ul class="list-unstyled navbar__list">
                <li class="kategori_tugas">
                    <a href="/">
                        <i class="fas fa-chart-bar"></i>Dashboard</a>
                </li>
                <li class="kategori_tugas">
                    <a href="/admin/kategori_tugas">
                        <i class="fas fa-file"></i>Kategori Tugas</a>
                </li>
                <li class="mata_pelajaran">
                    <a href="/admin/mata_pelajaran">
                        <i class="fas fa-table"></i>Mata Pelajaran</a>
                </li>
                <li class="kelas">
                    <a href="/admin/kelas">
                        <i class="fas fa-chalkboard"></i>Kelas</a>
                </li>
                <li class="siswa">
                    <a href="/admin/siswa">
                        <i class="fas fa-users"></i>Siswa</a>
                </li>
                <li class="guru">
                    <a href="/admin/guru">
                        <i class="fas fa-users"></i>Guru</a>
                </li>
                <li class="jadwal">
                    <a href="/admin/jadwal">
                        <i class="fas fa-calendar"></i>Penjadwalan</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
