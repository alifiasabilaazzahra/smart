<section class="pt-md-5">
	@if($nilai_siswa)
		<p class="h4">Kelas : {{ $kelas->student_class_name }}</p>
		<table class="table table-striped">
			<tr>
				<th>
					Nama
				</th>
				<th>
					Nilai
				</th>
				<th>
					Status
				</th>
			</tr>

			@foreach($nilai_siswa as $key)
				<tr>
					<td>
						{{$key->student_name}}
					</td>
					<td>
						{{$key->task_point}}
					</td>
					<td>
						{{$key->status}}
					</td>
				</tr>
			@endforeach
		</table>
		
	<!-- <a href="/guru/ekspor_excell/{{$key->task_id}}/{{$key->student_class_id}}" class="btn btn-success">Ekspor Excell</a> -->
		@else
			Tidak ada
	@endif

</section>

