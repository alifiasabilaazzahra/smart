<section class="pt-md-5">
	<div class="row">
		<div class="col">
			<p class="h2">Materi Pembahasan</p>
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
			<th>Type</th>
			<th>Tanggal Buat</th>
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
					{{$key->theory_type}}
				</td>
				<td>
					{{$key->created_at}}
				</td>
				<td>
				<div class="row">
					<div class="col-2">
						<a href="{{ env('APP_URL') }}uploaded/materi/{{ $key->theory_url }}" class="btn btn-sm btn-primary">
							<i class="fas fa-download"></i>
						</a>
					</div>
				</div>
					
				</td>
			</tr>
		<?php $i++;?> 
		@endforeach
	</table>

	{{ $theory->links() }}
</section>