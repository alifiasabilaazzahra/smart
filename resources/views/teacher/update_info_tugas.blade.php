<?php foreach ($tugas as $key) {} ?>
<section class="pt-md-5">
	<form action="/guru/info_tugas" method="POST">
		{{ method_field('PUT') }}
		@csrf
		<input type="hidden" name="task_id" value="{{$key->task_id}}">
		<div class="row">
			<div class="col">
				<div class="row mt-3">
					<div class="col">
						<label for="task_name">Judul Tugas</label>
						<input type="text" name="task_name" value="{{$key->task_name}}" placeholder="Judul Tugas" class="form-control" required>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col">
						<label for="task_name">Deskripsi Tugas</label>
						<textarea name="task_description" id="deskripsi" rows="4" placeholder="Deskripsi Tugas" class="form-control" required>{{$key->task_description}}</textarea>
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