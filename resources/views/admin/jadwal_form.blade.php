<section class="pt-md-5">
    @if(!isset($jadwal))
    <div id="in">
        <p class="h4">
            Tambah Jadwal
        </p>
        <form action="/admin/jadwal" method="POST">
            @csrf
            <div class="form-group">
                <select name="teacher_id" class="form-control" placeholder="Guru" required>
                    <option value="">- Pilih Guru -</option>
                    @if (count($guru) > 0)
                    @foreach($guru as $guru)
                    <option value="{{ $guru->teacher_id }}">{{ $guru->name }}</option>
                    @endforeach
                    @endif
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
                <select name="subject_id" class="form-control" placeholder="Mapel" required>
                    <option value="">- Pilih Mapel -</option>
                    @if (count($mapel) > 0)
                    @foreach($mapel as $mpl)
                    <option value="{{ $mpl->subject_id }}">{{ $mpl->subject_name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="datetime-local" class="form-control" value="" placeholder="Jadwal Mulai"
                            name="schedule_start" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="datetime-local" class="form-control" value="" placeholder="Jadwal Selesai"
                            name="schedule_end" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary w-100">Simpan</button>
            </div>
        </form>
    </div>
    @else
    @foreach($jadwal as $val)
    <div id="up">
        <p class="h4">
            Update Jadwal
        </p>
        <form action="/admin/jadwal" method="POST">
            <input type="hidden" name="schedule_id" value="{{$val->schedule_id}}">
            @csrf
            {{ method_field('PUT') }}
            <div class="form-group">
                <select name="teacher_id" class="form-control" placeholder="Guru" required>
                    <option value="">- Pilih Guru -</option>
                    @if (count($guru) > 0)
                    @foreach($guru as $guru)
                    <option value="{{ $guru->teacher_id }}" selected="{{ $val->teacher_id === $guru->teacher_id }}">{{ $guru->name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <select name="student_class_id" class="form-control" placeholder="Kelas" required>
                    <option value="">- Pilih Kelas -</option>
                    @if (count($kelas) > 0)
                    @foreach($kelas as $kls)
                    <option value="{{ $kls->student_class_id }}" selected="{{ $val->student_class_id === $kls->student_class_id }}">{{ $kls->student_class_name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <select name="subject_id" class="form-control" placeholder="Mapel" required>
                    <option value="">- Pilih Mapel -</option>
                    @if (count($mapel) > 0)
                    @foreach($mapel as $mpl)
                    <option value="{{ $mpl->subject_id }}" selected="{{ $val->subject_id === $mpl->subject_id }}">{{ $mpl->subject_name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="datetime-local" class="form-control" value="{{ date('Y-m-d\TH:i:s', strtotime($val->schedule_start)) }}" placeholder="Jadwal Mulai"
                            name="schedule_start" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="datetime-local" class="form-control" value="{{ date('Y-m-d\TH:i:s', strtotime($val->schedule_end)) }}" placeholder="Jadwal Selesai"
                            name="schedule_end" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary w-100">Update</button>
            </div>
        </form>
    </div>
    @endforeach
    @endif
</section>
