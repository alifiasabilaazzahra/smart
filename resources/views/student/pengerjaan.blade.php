<style>
	.qst{
		height: 100px;
	}
	.bg-l-1{
		background: #eee;
	}

	[type="radio"]:checked,
[type="radio"]:not(:checked) {
    position: absolute;
    left: -9999px;
}
[type="radio"]:checked + label,
[type="radio"]:not(:checked) + label
{
    position: relative;
    padding-left: 28px;
    cursor: pointer;
    line-height: 20px;
    display: inline-block;
    color: #666;
}
[type="radio"]:checked + label:before,
[type="radio"]:not(:checked) + label:before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 18px;
    height: 18px;
    border: 1px solid #ddd;
    border-radius: 100%;
    background: #fff;
}
[type="radio"]:checked + label:after,
[type="radio"]:not(:checked) + label:after {
    content: '';
    width: 12px;
    height: 12px;
    background: #79CE00;
    position: absolute;
    top: 4px;
    left: 4px;
    border-radius: 100%;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
}
[type="radio"]:not(:checked) + label:after {
    opacity: 0;
    -webkit-transform: scale(0);
    transform: scale(0);
}
[type="radio"]:checked + label:after {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1);
}
.bg-n{
	background-color: rgb(121, 206, 0, 0.4);
	border-radius: 10px;
}
</style>
<?php 
if (!$ss): ?>
	<?php if ($Qquestion > 0): ?>
		<section class="pt-md-5">
			<div class="container">
				<div class="row mb-4">
					<div class="col text-center text-md-left">
						<p class="h4">
							Selamat Mengerjakan
						</p>
						<hr class="bg-dark">
					</div>
				</div>
			</div>
			<div class="container">
				<form action="/student/pengerjaan" method="POST">
					@csrf
					<input type="hidden" name="task_id" value="{{$id}}">
					<?php $i = 1; foreach ($soal as $key): ?>
						<div class="row">
							<div class="col">
								<div class="card">
									<div class="card-body">
											<div class="row">
												<div class="col-md-1 col-2 p-1 bg-n text-center align-self-start">
													<b><?php echo $i ?></b>
												</div>
												<div class="col align-self-center">
													<?php echo $key->task_question ?>
												</div>
											</div>
									</div>
								</div>
								
							</div>
						</div>
						<div class="row mb-3">
							<div class="col bg-light pl-4 pt-2 pb-2">
								<?php foreach ($task_question_option->where('task_question_id', $key->task_question_id)->orderBy('task_question_option', 'asc')->get() as $opt): ?>
									<div class="row mb-1">
										<div class="col-2 col-md-1 bg-n pt-1">
											<input type="radio" id="test<?php echo $opt->task_question_id.'a'.$opt->task_question_option ?>" name="pil[<?php echo $opt->task_question_id ?>]" value="<?php echo $opt->task_question_option ?>" required>
    										<label for="test<?php echo $opt->task_question_id.'a'.$opt->task_question_option ?>" class="h-100"><b><?php echo $opt->task_question_option ?></b></label>
										</div>
										<div class="col-10 pt-1">
											<?php echo $opt->task_question_option_description ?>
										</div>
									</div>
								<?php endforeach ?>
							</div>
						</div>
					<?php $i++; endforeach ?>

					<button type="submit" class="btn btn-success w-100">
						Selesai
					</button>
				</form>
				
			</div>
		</section>
		<?php else: ?>
			<p class="pt-5">
				Soal belum ada
			</p>
	<?php endif ?>
	

		<?php else: ?>
	<section class="pt-5 pb-5">
			Kamu Sudah Selesai Mengerjakan Soal
	</section>
<?php endif ?>

<script>
window.onbeforeunload = function() {
   return "Yakin?";
};
</script>