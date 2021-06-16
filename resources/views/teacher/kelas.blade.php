<?php if ($tasks) {
	foreach ($tasks as $key) {}
} ?>

@if($tasks)
	<section class="pt-5">
	<p class="h5">
		Tugas: {{$key->task_name}}
	</p>
	<form action="/guru/kelas/" method="POST" required>
		@csrf
		<input type="hidden" name="task_id" value="{{$key->task_id}}">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<select name="student_class" class="form-control" required>
						<option value="">Pilih Kelas</option>
						@foreach($kelas as $cls)
							<option value="{{$cls->student_class_id}}">
								{{$cls->student_class_name}}
							</option>
						@endforeach
					</select>

					<button class="btn btn-primary float-right w-50">Tambah</button>
				</div>
			</div>
		</div>
	</form>

	@if(isset($msg))
		{{$msg}}
	@endif
	<table class="table table-striped mt-3">
		<tr>
			<th>Kelas</th>
			<th>Aksi</th>
		</tr>
		@foreach($task_class as $qc)
			<tr>
				<td>
					{{$qc->student_class_name}}
				</td>
				<td>
					<div class="row">
						<div class="col-md-3">
							<a href="/guru/send_email/{{$qc->task_id}}/{{$qc->student_class_id}}" class="btn btn-success">Kirim Notifikasi</a>
						</div>
						<div class="col-md-3">
							<form action="/guru/kelas/{{$qc->task_class_id}}" method="POST">
								{{method_field('DELETE')}}
								@csrf
								<input type="hidden" name="task_id" value="{{$qc->task_id}}">
								<button type="submit" class="btn btn-danger w-100" onclick="return confirm('Yakin menghapus ini?')">
									<i class="fas fa-trash"></i>
								</button>
							</form>
						</div>
					</div>
				</td>
			</tr>
		@endforeach
	</table>
</section>
@endif
