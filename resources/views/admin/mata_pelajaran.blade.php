<section class="pt-md-5">
	<div class="row">
		<div class="col">
			<p class="h2">Mata Pelajaran</p>
		</div>
		<div class="col text-right">
			<div class="alert alert-primary">
				<p class="h5">
					Jumlah MAPEL: {{$jumlah_mata_pelajaran}}
				</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col"></div>
		<div class="col-2">
			<a href="/admin/tambah_mata_pelajaran" class="btn btn-success w-100">
				Tambah Data
			</a>
		</div>
	</div>

	<table class="table table-striped">
		<tr>
			<th>
				Kode
			</th>
			<th>
				Nama
			</th>
			<th>
				Deskripsi
			</th>
			<th>
				Aksi
			</th>
		</tr>

		<?php $i=1; ?>
		@foreach($mata_pelajaran as $key)
			<tr>
				<td>
					{{$key->subject_id}}
				</td>
				<td>
					{{$key->subject_name}}
				</td>
				<td>
					{{$key->subject_description}}
				</td>
				<td>
				<div class="row">
					<div class="col-2">
						<a href="/admin/update_mata_pelajaran/{{$key->subject_id}}" class="btn btn-sm btn-info">
							<i class="fas fa-edit"></i>
						</a>
					</div>
					<div class="col-2">
						<form action="/admin/mata_pelajaran" method="POST">
						{{ method_field('DELETE') }}
						@csrf
							<input type="hidden" name="subject_id" value="{{$key->subject_id}}">
							<button type="submit" onclick="return confirm('Yakin menghapus {{$key->subject_name}}')" class="btn btn-sm btn-danger">
								<i class="fas fa-trash"></i>
							</button>
						</form>
					</div>
				</div>
				</td>
			</tr>

			<?php $i++;?>
		@endforeach
	</table>
</section>