<section class="pt-md-5">
    @if(!isset($siswa))
    <div id="in">
        <p class="h4">
            Tambah Siswa
        </p>
        <form action="/admin/siswa" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="student_id" value="" placeholder="NIS" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="text" name="student_name" value="" placeholder="Nama Siswa" class="form-control" required>
            </div>
            <div class="form-group">
                <select name="student_gender" class="form-control" placeholder="Jenis Kelamin">
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <select name="student_class_id" class="form-control" placeholder="Kelas" required>
                    <option value="">- Pilih Kelas -</option>
                    @if (count($kelas) > 0)
                    @foreach($kelas as $kls)
                    <option value="{{ $kls->student_class_id }}">{{ $kls->student_class_name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" min="1900" max="2099" step="1" value="" placeholder="Tahun masuk"
                    name="student_start" />
            </div>
            <div class="form-group">
                <input type="email" placeholder="Email" class="form-control" name="email" required value="">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password" class="form-control" name="password" required value="">
            </div>
            <div class="form-group">
                <button class="btn btn-primary w-100">Simpan</button>
            </div>
        </form>
    </div>
    @else
    @foreach($siswa as $val)
    <div id="up">
        <p class="h4">
            Update Siswa
        </p>
        <form action="/admin/siswa" method="POST">
            <input type="hidden" name="user_id" value="{{$val->user_id}}">
            @csrf
            {{ method_field('PUT') }}
			<div class="form-group">
                <input type="text" name="student_name" value="{{ $val->account->student_name }}" placeholder="Nama Siswa" class="form-control" required>
            </div>
            <div class="form-group">
                <select name="student_gender" class="form-control" placeholder="Jenis Kelamin">
					@if ($val->account->student_gender === "laki-laki")
                    <option value="laki-laki" selected>Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
					@else
					<option value="laki-laki">Laki-laki</option>
                    <option value="perempuan" selected>Perempuan</option>
					@endif
                </select>
            </div>
            <div class="form-group">
                <select name="student_class_id" class="form-control" placeholder="Kelas" required>
                    <option value="">- Pilih Kelas -</option>
                    @if (count($kelas) > 0)
                    @foreach($kelas as $kls)
                    <option value="{{ $kls->student_class_id }}" selected="{{ $val->account->student_class_id === $kls->student_class_id }}">{{ $kls->student_class_name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" min="1900" max="2099" step="1" placeholder="Tahun masuk"
                    name="student_start" value="{{ (int)$val->account->student_start }}"/>
            </div>
			<div class="form-group">
                <input type="number" class="form-control" min="1900" max="2099" step="1" placeholder="Tahun keluar"
                    name="student_end" value="{{ (int)$val->account->student_end }}"/>
            </div>
			<input type="hidden" name="student_status" value="{{ $val->account->student_status }}">
            <div class="form-group">
                <input type="password" placeholder="Password" class="form-control" name="password" required value="{{ $val->password }}">
            </div>
            <div class="form-group">
                <button class="btn btn-primary w-100">Update</button>
            </div>
        </form>
    </div>
	@endforeach
    @endif
</section>
