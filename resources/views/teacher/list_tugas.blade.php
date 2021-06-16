                <section class="au-breadcrumb m-t-75">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="au-breadcrumb-content">
                                        <div class="au-breadcrumb-left">
                                            <span class="au-breadcrumb-span"></span>
                                        </div>
                                        <a href="/guru/buat_tugas" class="au-btn au-btn-icon au-btn--green">
                                            <i class="zmdi zmdi-plus"></i>Buat Tugas</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="tugas" class="pt-4">
                    <div class="container">
                        <div class="row">
                            @foreach($tugas as $key)
                                <div class="col-lg-6">
                                    <div class="au-card chart-percent-card">
                                        <div class="au-card-inner">
                                            <h3 class="title-2 tm-b-5">
                                                @if(strtotime($key->task_schedule_end) < strtotime(date('Y-m-d')))
                                                        <p class="h5 text-danger">
                                                            Tugas ini sudah kadaluwarsa
                                                        </p>
                                                @endif
                                             <i class="fas fa-file"></i> {{$key->task_name}}</h3>
                                            <div class="row no-gutters pt-3">
                                                <p class="w-100">{{$key->task_description}}</p>
                                                <p class="w-100">
                                                    Mulai: {{$yand->split_date($key->task_schedule_start)}} <br>
                                                    Selesai: {{$yand->split_date($key->task_schedule_end)}}
                                                </p>
                                                <div class="row w-100 pt-2">
                                                    <div class="col-md-6">
                                                        <a href="/guru/tinjau_tugas/{{$key->task_id}}" class="btn btn-outline-primary w-100"> <i class="fas fa-eye"></i> Tinjau Tugas</a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="/guru/tinjau_nilai/{{$key->task_id}}" class="btn btn-primary w-100"> <i class="fas fa-list"></i> Tinjau Nilai</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                        </div>
                    </div>
                </section>