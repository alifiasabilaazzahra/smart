<section class="pt-md-5">
    @if(!isset($guru))
    <div id="in">
        <p class="h4">
            Tambah Guru
        </p>
        <form action="/admin/guru" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="teacher_id" value="" placeholder="NIK" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="text" name="name" value="" placeholder="Nama Guru" class="form-control" required>
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
    @foreach($guru as $val)
    <div id="up">
        <p class="h4">
            Update Guru
        </p>
        <form action="/admin/guru" method="POST">
            <input type="hidden" name="user_id" value="{{$val->user_id}}">
            @csrf
            {{ method_field('PUT') }}
			<div class="form-group">
                <input type="text" name="name" value="{{ $val->account->name }}" placeholder="Nama Guru" class="form-control" required>
            </div>
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
