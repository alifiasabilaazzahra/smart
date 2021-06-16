<section class="pt-md-5">
	<?php if ($nilai_siswa): ?>
		<table class="table table-striped">
			<tr>
				<th>
					Quiz ID
				</th>
				<th>
					Nilai
				</th>
				<th>
					Status
				</th>
			</tr>

			<?php foreach ($nilai_siswa as $key): ?>
				<tr>
					<td>
						<?php echo $key->task_name ?>
					</td>
					<td>
						<?php echo $key->task_point ?>
					</td>
					<td>
						<?php echo $key->status ?>
					</td>
				</tr>
			<?php endforeach ?>
		</table>

		<?php else: ?>
			Belum ada tugas yang dikerjakan
	<?php endif ?>
</section>