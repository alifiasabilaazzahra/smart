<section class="pt-md-5">
	@if(!isset($mata_pelajaran))
		<div id="in">
			<p class="h4">
				Tambah Mata Pelajaran
			</p>
			<form action="/admin/mata_pelajaran" method="POST">
				@csrf
				<div class="form-group">
					<input type="text" name="subject_name" value="" placeholder="Nama Mata Pelajaran" class="form-control" required>
				</div>
				<div class="form-group">
					<textarea name="subject_description" id="task_category_description" rows="4" placeholder="Deskripsi" class="form-control" required></textarea>
				</div>
				<div class="form-group">
					<button class="btn btn-primary w-100">Simpan</button>
				</div>
			</form>
		</div>
		@else:
		<?php foreach ($mata_pelajaran as $val) {} ?>
			<div id="up">
				<p class="h4">
					Update Kategori Tugas
				</p>
				<form action="/admin/mata_pelajaran" method="POST">
				<input type="hidden" name="subject_id" value="{{$val->subject_id }}">
					@csrf
					{{ method_field('PUT') }}
					<div class="form-group">
						<input type="text" name="subject_name" value="{{$val->subject_name}}" placeholder="Nama Kategori" class="form-control" required>
					</div>
					<div class="form-group">
						<textarea name="subject_description" id="subject_description" rows="4" placeholder="Deskripsi" class="form-control" required>{{$val->subject_description}}</textarea>
					</div>
					<div class="form-group">
						<button class="btn btn-primary w-100">Update</button>
					</div>
				</form>
			</div>
	@endif
</section>