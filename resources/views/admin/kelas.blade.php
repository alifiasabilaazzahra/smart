<section class="pt-md-5">
	<div class="row">
		<div class="col">
			<p class="h2">Kelas</p>
		</div>
		<div class="col text-right">
			<div class="alert alert-primary">
				<p class="h5">
					Jumlah Kelas: {{$jumlah_kelas}}
				</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col"></div>
		<div class="col-2">
			<a href="/admin/tambah_kelas" class="btn btn-success w-100">
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
		@foreach($kelas as $key)
			<tr>
				<td>
					{{$key->student_class_id}}
				</td>
				<td>
					{{$key->student_class_name}}
				</td>
				<td>
					{{$key->student_class_description}}
				</td>
				<td>
				<div class="row">
					<div class="col-2">
						<a href="/admin/update_kelas/{{$key->student_class_id}}" class="btn btn-sm btn-info">
							<i class="fas fa-edit"></i>
						</a>
					</div>
					<div class="col-2">
						<form action="/admin/kelas" method="POST">
						@csrf
						{{ method_field('DELETE') }}
							<input type="hidden" name="student_class_id" value="{{$key->student_class_id}}">
							<button type="submit" onclick="return confirm('Yakin menghapus {{$key->student_class_name}}')" class="btn btn-sm btn-danger">
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

	{{ $kelas->links() }}
</section>