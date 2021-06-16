<?php if ($guru) {
	foreach ($guru as $key) {}
} ?>

@if($guru)
	<section class="pt-5">
	<p class="h5">
		Guru: {{$key->name}}
	</p>
	<form action="/admin/guru/mapel" method="POST" required>
		@csrf
		<input type="hidden" name="teacher_id" value="{{$key->teacher_id}}">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<select name="subject" class="form-control" required>
						<option value="">Pilih Mapel</option>
						@foreach($mapel as $cls)
							<option value="{{$cls->subject_id}}">
								{{$cls->subject_name}}
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
			<th>Mapel</th>
			<th>Aksi</th>
		</tr>
		@foreach($guru_mapel as $qc)
			<tr>
				<td>
					{{$qc->subject_name}}
				</td>
				<td>
					<div class="row">
						<div class="col-md-3">
							<form action="/admin/guru/mapel/{{$qc->teacher_subject_id}}" method="POST">
								{{method_field('DELETE')}}
								@csrf
								<input type="hidden" name="teacher_id" value="{{$qc->teacher_id}}">
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
