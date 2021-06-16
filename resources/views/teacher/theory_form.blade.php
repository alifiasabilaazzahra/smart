<section class="pt-md-5">
    @if(!isset($theory))
    <div id="in">
        <p class="h4">
            Tambah Materi Pembahasan
        </p>
        <form action="/guru/materi" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" name="theory_name" value="" placeholder="Nama Materi" class="form-control" required>
            </div>
            <div class="form-group">
                <textarea name="theory_description" id="theory_description" rows="4" placeholder="Deskripsi"
                    class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <select name="theory_type" id="theory_type" placeholder="Tipe Materi" class="form-control">
                    <option value="Video">Video</option>
                    <option value="File">File</option>
                </select>
            </div>
            <div class="form-group">
                <select name="subject_id" id="subject_id" placeholder="Mata Pelajaran" class="form-control">
                    <option value="">- Pilih Mata Pelajaran -</option>
                    @if (count(Auth::user()->account->subjects) > 0)
                    @foreach(Auth::user()->account->subjects as $sbj)
                    <option value="{{$sbj->subject_id}}">
                        {{$sbj->subject_name}}
                    </option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <input type="file" name="theory_url" id="theory_url" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-primary w-100">Simpan</button>
            </div>
        </form>
    </div>
    @else:
    <?php foreach ($theory as $val) {} ?>
    <div id="up">
        <p class="h4">
            Update Materi Pembahasan
        </p>
        <form action="/guru/materi" method="POST">
            <input type="hidden" name="theory_id" value="{{$val->theory_id }}">
            @csrf
            {{ method_field('PUT') }}
            <div class="form-group">
                <input type="text" name="theory_name" value="{{$val->theory_name}}" placeholder="Nama Materi"
                    class="form-control" required>
            </div>
            <div class="form-group">
                <textarea name="theory_description" id="theory_description" rows="4" placeholder="Deskripsi"
                    class="form-control" required>{{$val->theory_description}}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary w-100">Update</button>
            </div>
        </form>
    </div>
    @endif
</section>
