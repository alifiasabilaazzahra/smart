                <section class="au-breadcrumb m-t-75">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="au-breadcrumb-content">
                                        <div class="au-breadcrumb-left">
                                            <div class="row">
                                                <div class="col">
                                                    <span class="au-breadcrumb-span"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="/guru/buat_tugas" class="au-btn au-btn-icon au-btn--green">
                                            <i class="zmdi zmdi-plus"></i>Buat Tugas
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="container-fluid">
                    <!-- <div class="row m-t-25">
                        <div class="col-lg-3">
                            <div class="overview-item overview-item--c2">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix pb-3">
                                        <div class="icon">
                                            <i class="zmdi  zmdi-folder-outline"></i>
                                        </div>
                                        <div class="text">
                                            <h2>
                                                {{$jumlah_tugas}}
                                            </h2>
                                            <span>Tugas diupload</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="row mt-3">
                        <div class="col-lg-12 mb-3">
                            <p class="h3">Jadwal</p>
                        </div>
                        @if(count($jadwal) === 0) <p class="h4">
                            Belum ada jadwal
                        </p>
                        @else
                        @foreach($jadwal as $key)
                        <div class="col-lg-6">
                            <div class="au-card chart-percent-card">
                                <div class="au-card-inner">
                                    <h3 class="title-2 tm-b-5"> <i class="fas fa-file"></i>
                                        {{$key->subjects->subject_name}}
                                    </h3>
                                    <div class="row no-gutters">
                                        <p class="pt-3 pb-3">
                                            Pengajar : {{ $key->teachers->name}} <br />
                                            Kelas : {{ $key->student_classes->student_class_name}} <br />
                                            Jadwal : {{ $key->schedule_start}} - {{$key->schedule_end}}
                                        </p>
                                        <a href="/guru/ikuti-jadwal/{{$key->schedule_id}}"
                                            class="btn btn-lg btn-outline-primary w-100"> <i class="fas fa-eye"></i>
                                            Ikuti Jadwal</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <hr />
                    <div class="row pt-5">
                        <div class="col-lg-12 mb-3">
                            <p class="h3">Tugas</p>
                        </div>
                        @if($jumlah_tugas

                        < 1) <p class="h4">
                            Belum ada Tugas
                            </p>
                            @else
                            @foreach($tugas as $key)
                            <div class="col-lg-6">
                                <div class="au-card chart-percent-card">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 tm-b-5"> <i class="fas fa-file"></i>
                                            {{$key->task_name}}
                                        </h3>
                                        <div class="row no-gutters">
                                            <p class="pt-3 pb-3">
                                                {{$key->task_description}}
                                            </p>
                                            <a href="/guru/tinjau_tugas/{{$key->task_id}}"
                                                class="btn btn-lg btn-outline-primary w-100"> <i class="fas fa-eye"></i>
                                                Tinjau Tugas</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                    </div>
                </div>
