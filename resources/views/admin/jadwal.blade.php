<section class="pt-md-5">
    <div class="row">
        <div class="col">
            <p class="h2">Penjadwalan</p>
        </div>
        <div class="col text-right">
            <div class="alert alert-primary">
                <p class="h5">
                    Jumlah jadwal: {{$jumlah_jadwal}}
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col"></div>
        <div class="col-2">
            <a href="/admin/tambah_jadwal" class="btn btn-success w-100">
                Tambah Data
            </a>
        </div>
    </div>

    <table class="table table-striped">
        <tr>
            <th>
                No
            </th>
            <th>
                Nama Guru
            </th>
            <th>
                Kelas
            </th>
            <th>
                Mapel
            </th>
            <th>
                Periode
            </th>
            <th>
                Aksi
            </th>
        </tr>

        <?php $i=1; ?>
        @foreach($jadwal as $key)
        <tr>
            <td>
                {{$i}}
            </td>
            <td>
                {{$key->teachers->name}}
            </td>
            <td>
                {{$key->student_classes->student_class_name}}
            </td>
            <td>
                {{$key->subjects->subject_name}}
            </td>
            <td>
                {{$key->schedule_start}} - {{$key->schedule_end ? $key->schedule_end : "Sekarang"}}
            </td>
            <td>
                <div class="row">
                    <div class="col-3">
                        <a href="/admin/update_jadwal/{{$key->schedule_id}}" class="btn btn-sm btn-info">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                    <div class="col-3">
                        <form action="/admin/jadwal" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="schedule_id" value="{{$key->schedule_id}}">
                            <button type="submit" onclick="return confirm('Yakin menghapus jadwal ini')"
                                class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </td>
        </tr>
        <?php $i++;?>
        @endforeach
    </table>

    {{ $jadwal->links() }}
</section>
