<div class='w-100 d-flex justify-content-center'>
	<a class='card' href="<?php echo $href ?>">
		<div class='poster'>
			<img src='<?php echo $poster?>' alt='poster' />
		</div>
		<div class='detail'>
			<h2 class='name-film'>
				<?php echo $name ?>
			</h2>
			<h3 class='director'>Đạo diễn <?php echo $director ?></h3>

			<div class='tags d-flex justify-content-center p-2'>
				<span class='<?php echo $tagClass?>'><?php echo $tag?></span>
				<span class='film-2d d-flex align-items-center justify-content-center'>2D</span>
				<?php echo $span_3d ?>
			</div>
		</div>
	</a>
</div>