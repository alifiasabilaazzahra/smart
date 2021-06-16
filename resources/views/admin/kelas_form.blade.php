<section class="pt-md-5">
	@if(!isset($kelas))
		<div id="in">
			<p class="h4">
				Tambah Kelas
			</p>
			<form action="/admin/kelas" method="POST">
				@csrf
				<div class="form-group">
					<input type="text" name="student_class_name" value="" placeholder="Nama Kelas" class="form-control" required>
				</div>
				<div class="form-group">
					<textarea name="student_class_description" id="student_class_description" rows="4" placeholder="Deskripsi" class="form-control" required></textarea>
				</div>
				<div class="form-group">
					<button class="btn btn-primary w-100">Simpan</button>
				</div>
			</form>
		</div>
		@else
		<?php foreach ($kelas as $val) {} ?>
			<div id="up">
				<p class="h4">
					Update Kelas
				</p>
				<form action="/admin/kelas" method="POST">
				<input type="hidden" name="student_class_id" value="{{$val->student_class_id}}">
					@csrf
					{{ method_field('PUT') }}
					<div class="form-group">
						<input type="text" name="student_class_name" value="{{$val->student_class_name}}" placeholder="Nama Kategori" class="form-control" required>
					</div>
					<div class="form-group">
						<textarea name="student_class_description" rows="4" placeholder="Deskripsi" class="form-control text-left" required>{{$val->student_class_description}}</textarea>
					</div>
					<div class="form-group">
						<button class="btn btn-primary w-100">Update</button>
					</div>
				</form>
			</div>
	@endif
</section>