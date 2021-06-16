<section class="pt-md-5">
	@if(!isset($kategori_tugas))
		<div id="in">
			<p class="h4">
				Tambah Kategori Tugas
			</p>
			<form action="/admin/kategori_tugas" method="POST">
				@csrf
				<div class="form-group">
					<input type="text" name="task_category_name" value="" placeholder="Nama Kategori" class="form-control" required>
				</div>
				<div class="form-group">
					<textarea name="task_category_description" id="task_category_description" rows="4" placeholder="Deskripsi" class="form-control" required></textarea>
				</div>
				<div class="form-group">
					<button class="btn btn-primary w-100">Simpan</button>
				</div>
			</form>
		</div>
		@else
		<?php foreach ($kategori_tugas as $val) {} ?>
			<div id="up">
				<p class="h4">
					Update Kategori Tugas
				</p>
				<form action="/admin/kategori_tugas" method="POST">
				<input type="hidden" name="task_category_id" value="{{$val->task_category_id}}">
					@csrf
					{{ method_field('PUT') }}
					<div class="form-group">
						<input type="text" name="task_category_name" value="{{$val->task_category_name}}" placeholder="Nama Kategori" class="form-control" required>
					</div>
					<div class="form-group">
						<textarea name="task_category_description" rows="4" placeholder="Deskripsi" class="form-control text-left" required>{{$val->task_category_description}}</textarea>
					</div>
					<div class="form-group">
						<button class="btn btn-primary w-100">Update</button>
					</div>
				</form>
			</div>
	@endif
</section>