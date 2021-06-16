<style>
	.qst{
		height: 100px;
	}
	.bg-l-1{
		background: #eee;
	}
</style>
<section class="pt-5">
	<div class="container">
		<?php $i = 1;?>
		@foreach($soal as $key)
			<div class="row mb-3">
				<div class="col-md-8">
					<div class="bg-light pl-3 pr-3 qst">
						<div class="row">
							<div class="col-3 p-0">
								<a href="/guru/update_soal/{{$key->task_id}}/{{$key->task_question_id}}" class="btn btn-light w-100">Update Soal</a>
							</div>
							<div class="col bg-success text-white text-right">
								Pertanyaan no {{$i}}
							</div>
						</div>
						<div class="row">
							<div class="col text-right">
								Jawaban: {{$key->task_question_answer}}
							</div>
						</div>
						<div class="row">
							<div class="col pt-3">
								<?php echo $key->task_question?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row mb-3">
				<div class="col">
					<?php $amb=$bd->where('task_question_id', $key->task_question_id)->orderBy('task_question_option','asc')->get()?>
					@foreach($amb as $opt)
					<p>
						<span>
							<?php echo $opt->task_question_option ?>. 
						</span>
						<span>
							<?php echo $opt->task_question_option_description ?>
						</span>
					</p>
					@endforeach
				</div>
			</div>
		<?php $i++;?>
		@endforeach
	</div>
</section>