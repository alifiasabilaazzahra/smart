<aside class="menu-sidebar2">
            <div class="logo">
                <a href="#" class="navbar-brand text-white">
                    <img src="/assets/img/logo/logo.png" alt="Cool Admin" class="navbar-toggler-icon"/>
                   SmarT
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
                <div class="account2">
                    <div class="image img-cir img-120 bg-success text-white text-center">
                            <div class="row h-100">
                                <div class="col align-self-center h1">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                            </div>
                    </div>
                    <h4 class="name">
                        {{Auth::user()->account->student_name}}
                    </h4>
                    <h5 class="font-weight-normal">
                        {{Auth::user()->account->student_class_name}}
                    </h5>
                    <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </div>
                <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                        <li class="dashboard">
                            <a href="/student">
                                <i class="fas fa-chart-bar"></i> Dashboard</a>
                            <!-- <span class="inbox-num">3</span> -->
                        </li>
                        @if (count($mapel) > 0)
                        @foreach($mapel as $key)
                        <li class="materi">
                    <a href="/student/materi/{{$key->subject_id}}">
                        <i class="fas fa-book"></i>{{ $key->subject_name}}</a>
                        </li>
                        @endforeach
                        @endif
                        <li class="tugas">
                            <a href="/student/list_nilai">
                                <i class="fas fa-list"></i> Nilai</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>