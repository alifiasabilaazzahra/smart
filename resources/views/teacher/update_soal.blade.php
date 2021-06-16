<script src="/assets/ckeditor/ckeditor.js"></script>
<?php foreach ($soal as $key) {} ?>

<section class="pt-md-5">
	<form action="/guru/soal" method="POST">
	{{method_field('PUT')}}
		@csrf
		<div class="row mt-5 pt-5">
				<div class="col-md-8">
					<div class="row">
						<div class="col">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<textarea class="ckeditor" name="pertanyaan" class="form-control" required>
								{{$key->task_question}}
							</textarea>
						</div>
					</div>
					<div class="row pt-2">
						<div class="col-4 align-self-center text-center">
							<span class="h5 mr-3">Jawaban Benar:</span>
						</div>
						<div class="col-4 p-0">
							<select name="option" id="q_option" class="form-control" required>
								<option value="{{$key->task_question_answer}}">
									--- {{$key->task_question_answer}}---
								</option>
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="C">C</option>
								<option value="D">D</option>
								<option value="E">E</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="row">
						<p class="h5">Jawaban</p>
					</div>
					<?php $amb=$bd->where('task_question_id', $key->task_question_id)->orderBy('task_question_option','asc')->get()?>
					@foreach($amb as $opt)
					<div class="row">
							<div class="col">
								<label for="a">Option <?php echo $opt->task_question_option ?></label>
								<input type="text" name="<?php echo $opt->task_question_option ?>" value="<?php echo $opt->task_question_option_description ?>" placeholder="Masukan Jawaban.." class="form-control" required>
							</div>
					</div>
					@endforeach
				</div>
			</div> 
			<div class="input-group mt-3">
				<button class="btn btn-success w-100">
					Update
				</button>
			</div>
	</form>
</section>