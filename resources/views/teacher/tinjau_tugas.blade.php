<section class="pt-5">
	@foreach($jadwal as $jdwl)
	@foreach ($tugas as $key)
		<p class="h3 font-weight-bold">
			{{$key->task_name}}
		</p>
		@if(strtotime($jdwl->task_schedule_end) < strtotime(date('Y-m-d')))
            <p class="h5 text-danger">
                Tugas ini sudah kadaluwarsa
            </p>
        @endif
		<p>
			<div class="row">
				<div class="col-md-3">
					<a href="/guru/info_tugas/{{$id}}" class="btn btn-info w-100">Update Info Tugas</a>
				</div>
				<div class="col-md-2">
				<form action="/guru/tugas/{{$id}}" method="POST">
					{{method_field('DELETE')}}
					@csrf
					<button type="submit" class="btn btn-danger w-100" onclick="return confirm('Yakin menghapus ini?')">
						Hapus Tugas 
					</button>
				</form>
				</div>
			</div>
		</p>
		<div class="row pt-2">
			<div class="col">
				<table class="table table-striped">
					<tr>
						<td>
							Nama Tugas
						</td>
						<td>
							{{$key->task_name}}
						</td>
					</tr>
					<tr>
						<td>
							Jenis Tugas
						</td>
						<td>
							{{$key->task_category_name}}
						</td>
					</tr>
					<tr>
						<td>
							Deskripsi
						</td>
						<td>
							{{$key->task_description}}
						</td>
					</tr>
					<tr>
						<td>
							Jadwal Pengerjaan
						</td>
						<td>
							@if($jumlah_jadwal < 1)
								<form action="/guru/jadwal" method="POST">
									@csrf
									<span class="h5">Tambah Jadwal</span><br>
									<label for="mulai">Mulai</label>
									<input type="date" name="mulai" class="form-control mb-3">	
									<label for="selesai">Selesai</label>
									<input type="date" name="selesai" class="form-control">	
									<button class="btn btn-primary w-100">Tambah Jadwal</button>
								</form>

								@else
									{{$yand->split_date($jdwl->task_schedule_start)}} - {{$yand->split_date($jdwl->task_schedule_end)}}
							@endif
						</td>
					</tr>
					<tr>
						<td>
							Soal
						</td>
						<td>
							@if($jumlah_soal < 1)
								<form method="POST" action="/guru/tbhpertanyaan">
									@csrf
									<div class="row">
										<div class="col-4">
											<input type="hidden" name="task_id" value="{{$key->task_id}}">
											<input type="number" name="jumlah_pertanyaan" value="" placeholder="Jumlah Pertanyaan" class="form-control" required>
										</div>
										<div class="col-8">
											<button class="btn btn-success w-100">
												Tambah Pertanyaan
											</button>
										</div>
									</div>
								</form>
								@else
									<a href="/guru/soal/{{$id}}" class="btn btn-success w-100">Lihat Soal</a>
							@endif
							
						</td>
					</tr>
					<tr>
						<td>
							Tugas kelas
						</td>
						<td>
							<a href="/guru/data_kelas/{{$id}}" class="btn btn-primary w-100">
								List Kelas
							</a>
						</td>
					</tr>
				</table>
			</div>
		</div>
		@endforeach
	@endforeach
</section>