<div class="dangchieu" id="showing">
	<div class="mt-5 title text">
		<h2 class="mb-0">PHIM SẮP CHIẾU</h2>
	</div>
	<div class="type-film d-flex justify-content-between align-items-center flex-wrap">
		<button type="button" class="btn button-type-film-coming active" id="all-film-coming">
			Tất cả
		</button>
		<!-- <button type="button" class="btn button-type-film" id="film-2d">
			2D
		</button> -->
		<button type="button" class="btn button-type-film-coming" id="film-3d-coming">
			3D
		</button>
	</div>
	<div class="row-phim">
		<?php
		foreach ($data as $item) {
			$name = $item->name_phim;
			$director = $item->director;
			$tag = $item->name_nhanphim;
			$tagClass = strtolower($tag);
			$href = _WEB_ROOT . '/film/detail/' . $item->id_phim;
			$poster = _WEB_ROOT . "/public/assets/client/img/" . $item->image_path;
			$span_3d = ($item->phim_3d == 1) ? "<span
										class='film-3d d-flex align-items-center justify-content-center'
										>3D</span
									>" : "";
			echo
			"<div class='w-100 d-flex justify-content-center'>
						<a class='card' href=$href>
							<div class='poster'>
								<img src='$poster' alt='poster' />
							</div>
							<div class='detail'>
								<h2 class='name-film'>
									$name
								</h2>
								<h3 class='director'>Đạo diễn $director</h3>

								<div
									class='tags d-flex justify-content-center p-2'
								>
									<span class='$tagClass'>$tag</span>
									<span
										class='film-2d d-flex align-items-center justify-content-center'
										>2D</span
									>
									$span_3d
								</div>
							</div>
						</a>
					</div >";
		}

		?>
	</div>
</div>