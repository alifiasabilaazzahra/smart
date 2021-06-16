<section class="pt-md-5">
	<div class="row">
		<div class="col">
			<p class="h2">Materi Pembahasan</p>
		</div>
	</div>
	<div class="row">
		<div class="col"></div>
		<div class="col-2">
			<a href="/guru/tambah_materi" class="btn btn-success w-100">
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
		@foreach($theory as $key)
			<tr>
				<td>
					{{$i}}
				</td>
				<td>
					{{$key->theory_name}}
				</td>
				<td>
					{{$key->theory_description}}
				</td>
				<td>
				<div class="row">
					<div class="col-2">
						<a href="/guru/update_materi/{{$key->theory_id}}" class="btn btn-sm btn-primary">
							<i class="fas fa-edit"></i>
						</a>
					</div>
					<div class="col-2">
						<a href="/guru/assign-kelas/{{$key->theory_id}}" class="btn btn-sm btn-info">
							<i class="fas fa-upload"></i>
						</a>
					</div>
					<div class="col-2">
						<form action="/guru/materi" method="POST">
						@csrf
						{{ method_field('DELETE') }}
							<input type="hidden" name="theory_id" value="{{$key->theory_id}}">
							<button type="submit" onclick="return confirm('Yakin menghapus {{$key->theory_name}}')" class="btn btn-sm btn-danger">
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

	{{ $theory->links() }}
</section>