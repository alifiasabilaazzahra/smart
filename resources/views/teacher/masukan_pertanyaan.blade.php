<script src="/assets/ckeditor/ckeditor.js"></script>

<section class="pt-5">
	<div class="container">
		<form action="/guru/pertanyaan" method="POST">
			<input type="hidden" name="task_id" value="{{@session('task_id')}}">
			@csrf
		 	@for ($i=0; $i<$maks; $i++)
			<div class="row mt-5 pt-5">
				<div class="col-md-8">
					<div class="row">
						<div class="col">
							<p class="h5 bg-light text-right p-2">
								Soal Nomor {{$i+1}}
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<textarea class="ckeditor" name="pertanyaan[{{$i}}]" class="form-control" required></textarea>
						</div>
					</div>
					<div class="row pt-2">
						<div class="col">
							<span class="h5 mr-3">Jawaban Benar:</span>
							<input type="radio" name="option[{{$i}}]" value="A" required>
							<label for="A" class="mr-5">A</label>
							<input type="radio" name="option[{{$i}}]" value="B">
							<label for="B" class="mr-5">B</label>
							<input type="radio" name="option[{{$i}}]" value="C">
							<label for="C" class="mr-5">C</label>
							<input type="radio" name="option[{{$i}}]" value="D">
							<label for="D" class="mr-5">D</label>
							<input type="radio" name="option[{{$i}}]" value="E">
							<label for="E" class="mr-5">E</label>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="row">
						<p class="h5">Jawaban</p>
					</div>
					<div class="row">
						<div class="col">
							<label for="a">Option A</label>
							<input type="text" name="a[{{$i}}]" value="" placeholder="Masukan Jawaban.." class="form-control" required>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label for="a">Option B</label>
							<input type="text" name="b[{{$i}}]" value="" placeholder="Masukan Jawaban.." class="form-control" required>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label for="a">Option C</label>
							<input type="text" name="c[{{$i}}]" value="" placeholder="Masukan Jawaban.." class="form-control" required>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label for="a">Option D</label>
							<input type="text" name="d[{{$i}}]" value="" placeholder="Masukan Jawaban.." class="form-control" required>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label for="a">Option E</label>
							<input type="text" name="e[{{$i}}]" value="" placeholder="Masukan Jawaban.." class="form-control" required>
						</div>
					</div>
				</div>
			</div> 
			@endfor 
		 

		<div class="row">
			<div class="col p-5">
				<button type="submit" class="btn btn-primary btn-lg w-100">
					Selesai
				</button>
			</div>
		</div>
		
		</form>
	</div>
</section>


<script>
// Warning before leaving the page (back button, or outgoinglink)
window.onbeforeunload = function() {
   return "Yakin?";
   //if we return nothing here (just calling return;) then there will be no pop-up question at all
   //return;
};
</script>