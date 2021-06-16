<section class="pt-md-5">
    <div class="row">
        <div class="col">
            <p class="h2">Guru</p>
        </div>
        <div class="col text-right">
            <div class="alert alert-primary">
                <p class="h5">
                    Jumlah guru: {{$jumlah_guru}}
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col"></div>
        <div class="col-2">
            <a href="/admin/tambah_guru" class="btn btn-success w-100">
                Tambah Data
            </a>
        </div>
    </div>


    <table class="table table-striped">
        <tr>
            <th>
                NIK
            </th>
            <th>
                Nama
            </th>
            <th>
                Mapel
            </th>
            <th>
                Aksi
            </th>
        </tr>

        <?php $i=1; ?>
        @foreach($guru as $key)
        <tr>
            <td>
                {{$key->teacher_id}}
            </td>
            <td>
                {{$key->name}}
            </td>
            <td>
                @if (count($key->subjects) > 0)
                @foreach($key->subjects as $subject)
                - {{ $subject->subject_name}}<br/>
                @endforeach
                @endif
            </td>
            <td>
                <div class="row">
                    <div class="col-2">
                        <a href="/admin/update_guru/{{$key->user_id}}" class="btn btn-sm btn-info">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                    <div class="col-2">
						<a href="/admin/assign-mapel/{{$key->teacher_id}}" class="btn btn-sm btn-info">
							<i class="fas fa-upload"></i>
						</a>
					</div>
                    <div class="col-2">
                        <form action="/admin/guru" method="POST">
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

    {{ $guru->links() }}
</section>
