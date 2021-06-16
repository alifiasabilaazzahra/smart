<section class="pt-5">
	<form action="<?php echo base_url('guru/aksi_input_data_diri') ?>" method="POST">
		<div class="container-fluid">
			<div class="col-md-8">
				<div class="row">
					<div class="col-6">
						<select name="ptk_category" id="kategori" class="form-control" required>
							<option value="">Pilih Mata Pelajaran</option>
							<?php foreach ($this->db->get('ptk_category')->result() as $key): ?>
								<option value="<?php echo $key->ptk_category_id ?>"><?php echo $key->ptk_category_name ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="nik">Nomor Induk Kependudukan</label>
					<input type="text" name="ptk_nik" value="" placeholder="Nik" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="nik">NIP</label>
					<input type="text" name="ptk_nip" value="" placeholder="NIP" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="nik">NUPTK</label>
					<input type="text" name="ptk_nuptk" value="" placeholder="NUPTK" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="nik">Status</label>
					<select name="ptk_staffing_status" class="form-control" required>
						<option value="">Pilih Status</option>
						<option value="PNS">PNS</option>
						<option value="HONORER">Honorer</option>
						<option value="LAINNYA">Lainnya</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Nama</label>
					<input type="text" name="ptk_name" value="" placeholder="Nama" required>
				</div>
				<div class="form-group">
					<label for="">Jenis Kelamin</label>
					<select name="ptk_gender" class="form-control">
						<option value="">--Jenis Kelamin</option>
						<option value="LAKI-LAKI">Laki-laki</option>
						<option value="PEREMPUAN">Perempuan</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Alamat</label>
					<textarea name="ptk_address" rows="4" class="form-control" placeholder="Alamat" required></textarea>
				</div>
				<div class="form-group">
					<label for="phone">Nomor Telepon</label>
					<input type="tel" name="ptk_phone" value="" placeholder="Nomor Telepon" class="form-control">
				</div>
				<div class="form-group">
					<label for="">Tempat Lahir</label>
					<input type="text" name="ptk_place_of_birth" value="" placeholder="Tempat Lahir" class="form-control">
				</div>
				<div class="form-group">
					<label for="">Tanggal Lahir</label>
					<input type="date" name="ptk_date_of_birth" value="" class="form-control">
				</div>
				<div class="form-group">
					<label for="">Pendidikan Terakhir</label>
					<input type="text" name="ptk_last_educatio" value="" placeholder="Pendidikan terakhir" class="form-control">
				</div>
				<div class="form-group">
					<label for="">Major education</label>
					<input type="text" name="ptk_major_education" value="" placeholder="Pendidikan" class="form-control">
				</div>
				<div class="form-group">
					<button class="btn btn-success w-100">Selesai</button>
				</div>
			</div>
		</div>
	</form>
</section>