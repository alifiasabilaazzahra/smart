<section class="pt-md-5">
	<div class="row">
		<div class="col">
			<p class="h2">Kategori Tugas</p>
		</div>
		<div class="col text-right">
			<div class="alert alert-primary">
				<p class="h5">
					Jumlah Kategori: {{$jumlah_kategori_tugas}}
				</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col"></div>
		<div class="col-2">
			<a href="/admin/tambah_kategori_tugas" class="btn btn-success w-100">
				Tambah Data
			</a>
		</div>
	</div>

	<table class="table table-striped">
		<tr>
			<th>
				No
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
		@foreach($kategori_tugas as $key)
			<tr>
				<td>
					{{$i}}
				</td>
				<td>
					{{$key->task_category_name}}
				</td>
				<td>
					{{$key->task_category_description}}
				</td>
				<td>
				<div class="row">
					<div class="col-2">
						<a href="/admin/update_kategori_tugas/{{$key->task_category_id}}" class="btn btn-sm btn-info">
							<i class="fas fa-edit"></i>
						</a>
					</div>
					<div class="col-2">
						<form action="/admin/kategori_tugas" method="POST">
						@csrf
						{{ method_field('DELETE') }}
							<input type="hidden" name="task_category_id" value="{{$key->task_category_id}}">
							<button type="submit" onclick="return confirm('Yakin menghapus {{$key->task_category_name}}')" class="btn btn-sm btn-danger">
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

	{{ $kategori_tugas->links() }}
</section>