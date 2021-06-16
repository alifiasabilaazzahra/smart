							<section class="pt-5">
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
							                        <a href="/student/ikuti-jadwal/{{$key->schedule_id}}"
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
							    <div class="row">
							        <div class="col-lg-12 mb-3">
							            <p class="h3">Tugas</p>
							        </div>
							        @if(count($tasks) === 0) <p class="h4">
							            Belum ada tugas
							        </p>
							        @else
							        <?php foreach ($tasks as $key): ?>
							        <div class="col-md-6">
							            <div class="au-card chart-percent-card">
							                <div class="au-card-inner">
							                    <div class="row">
							                        <div class="col">
							                            <h3 class="title-2 tm-b-5"> <i class="fas fa-file"></i> <?php echo $key->task_name ?>
							                            </h3>
							                        </div>
							                        <div class="col-4 text-center">
							                            <?php if ($Qpoint->where('task_id', $key->task_id)->where('student_id', $id_siswa)->count() < 1): ?>
							                            <p class="badge-danger">Belum dikerjakan</p>
							                            <?php endif ?>
							                        </div>
							                    </div>
							                    <div class="row no-gutters">
							                        <p class="pt-3 pb-3">
							                            Batas: <?php echo $yand->split_date($key->task_schedule_end) ?>
							                        </p>
							                        <?php if (strtotime($key->task_schedule_end) < strtotime(date('Y-m-d H:i:s'))): ?>
							                        <a href="#" class="btn btn-outline-danger w-100 disabled">Tugas Sudah Kadaluswarsa</a>
							                        <?php else: ?>
							                        <a href="/student/pengerjaan/{{$key->task_id}}"
							                            class="btn btn-lg btn-outline-primary w-100"> <i class="fas fa-eye"></i> Tinjau
							                            Tugas</a>
							                        <?php endif ?>
							                    </div>
							                </div>
							            </div>
							        </div>
							        <?php endforeach ?>
                                    @endif
							    </div>

							</section>
