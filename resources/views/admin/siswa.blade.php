<section class="pt-md-5">
    <div class="row">
        <div class="col">
            <p class="h2">Siswa</p>
        </div>
        <div class="col text-right">
            <div class="alert alert-primary">
                <p class="h5">
                    Jumlah siswa: {{$jumlah_siswa}}
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <form action="/admin/siswa" method="GET">
                <div class="form-group">
                    <select name="student_class_id" class="form-control">
                        <option value="">- Filter Kelas -</option>
                        @if (count($kelas) > 0)
                        @foreach($kelas as $kls)
                        <option value="{{ $kls->student_class_id }}">{{ $kls->student_class_name}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <button type="submit" class="mt-2 btn btn-primary">Filter</button>
            </form>
        </div>
        <div class="col-md-2">
            <a href="/admin/tambah_siswa" class="btn btn-success w-100">
                Tambah Data
            </a>
        </div>
    </div>

    <table class="table table-striped">
        <tr>
            <th>
                NIS
            </th>
            <th>
                Nama
            </th>
            <th>
                Kelas
            </th>
            <th>
                Gender
            </th>
            <th>
                Periode
            </th>
            <th>
                Status
            </th>
            <th>
                Aksi
            </th>
        </tr>

        <?php $i=1; ?>
        @foreach($siswa as $key)
        <tr>
            <td>
                {{$key->student_id}}
            </td>
            <td>
                {{$key->student_name}}
            </td>
            <td>
                {{$key->student_class}}
            </td>
            <td>
                {{$key->student_gender}}
            </td>
            <td>
                {{$key->student_start}} - {{$key->student_end ? $key->student_end : "Sekarang"}}
            </td>
            <td>
                {{$key->student_status}}
            </td>
            <td>
                <div class="row">
                    <div class="col-2">
                        <a href="/admin/update_siswa/{{$key->user_id}}" class="btn btn-sm btn-info">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                    @if ($key->student_status === "Belum Lulus")
                    <div class="col-2">
                        <form action="/admin/siswa" method="POST">
                            @csrf
                            {{ method_field('PUT') }}
                            <input type="hidden" name="user_id" value="{{$key->user_id}}">
                            <input type="hidden" name="student_status" value="Lulus">
                            <button type="submit" onclick="return confirm('Ubah status lulus {{$key->student_name}}')"
                                class="btn btn-sm btn-warning">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="col-2">
                        <form action="/admin/siswa" method="POST">
                            @csrf
                            {{ method_field('PUT') }}
                            <input type="hidden" name="user_id" value="{{$key->user_id}}">
                            <input type="hidden" name="student_status" value="Belum Lulus">
                            <button type="submit"
                                onclick="return confirm('Ubah status belum lulus {{$key->student_name}}')"
                                class="btn btn-sm btn-primary">
                                <i class="fas fa-ban"></i>
                            </button>
                        </form>
                    </div>
                    @endif
                    <div class="col-2">
                        <form action="/admin/siswa" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="user_id" value="{{$key->user_id}}">
                            <button type="submit" onclick="return confirm('Yakin menghapus {{$key->student_name}}')"
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

    {{ $siswa->links() }}
</section>
