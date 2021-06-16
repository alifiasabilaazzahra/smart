<section class="pt-5">
	<form action="/guru/tugas" method="POST">
		@csrf
		<div class="row">
			<div class="col">
				<div class="row">
					<div class="col-md-6">
						<label for="category">Kategori Tugas</label>
						<select name="task_category_id" id="qci" class="form-control" required>
							<option value="">--Pilih Kategori</option>
							@foreach($task_category as $key)
								<option value="{{$key->task_category_id}}">
									{{$key->task_category_name}}
								</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6">
						<label for="subject">Mata Pelajaran</label>
						<select name="subject_id" id="qsi" class="form-control" required>
							<option value="">--Pilih Mata Pelajaran</option>
							@if (count(Auth::user()->account->subjects) > 0)
							@foreach(Auth::user()->account->subjects as $sbj)
								<option value="{{$sbj->subject_id}}">
									{{$sbj->subject_name}}
								</option>
							@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col">
						<label for="task_name">Judul Tugas</label>
						<input type="text" name="task_name" value="" placeholder="Judul Tugas" class="form-control" required>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col">
						<label for="task_name">Deskripsi Tugas</label>
						<textarea name="task_description" id="deskripsi" rows="4" placeholder="Deskripsi Tugas" class="form-control" required></textarea>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-md-6">
						<label for="mulai">Mulai</label>
						<input type="dateTime-local" name="mulai" class="form-control mb-3" required>	
					</div>
					<div class="col-md-6">
						<label for="selesai">Selesai</label>
						<input type="dateTime-local" name="selesai" class="form-control" required>
					</div>	
				</div>
				<div class="row mt-2">
					<div class="col">
						<button class="btn btn-primary w-100">
							Selesai
						</button>
					</div>
				</div>
			</div>
		</div>
		
	</form>
</section>