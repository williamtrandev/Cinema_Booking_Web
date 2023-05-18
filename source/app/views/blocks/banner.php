<div id="myCarousel" class="my-container carousel slide carousel-fade" data-bs-ride="carousel">
	<div class="carousel-inner">
		<?php 
			$i = 1;
			foreach($info as $item) {
				$active = $i == 1? 'active' : '';
				echo "<div class='carousel-item $active'>
					<img src='"._WEB_ROOT."/public/assets/client/img/$item->banner_path' alt='...' />
				</div>";
			}
		?>
		
	</div>
	<button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
	</button>
</div>