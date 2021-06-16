<section class="pt-md-4">


	<p class="h3 pt-md-4 text-center pb-3" id="dap">

	</p>
	<table class="table table-striped">
		<tr>
			<th>
				Nama Kelas
			</th>
			<th>
				Aksi
			</th>
		</tr>
		@foreach($tasks as $key)
			<tr>
				<td>
					{{$key->student_class_name}}
				</td>
				<td>
					<a href="/guru/tinjau_nilai_kelas/{{$key->task_id}}/{{$key->student_class_id}}" class="btn btn-success">
						Lihat Nilai
					</a>
				</td>
			</tr>
		@endforeach
	</table>
</section>

<script>
	
</script>