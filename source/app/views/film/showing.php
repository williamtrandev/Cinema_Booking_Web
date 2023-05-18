<div class="dangchieu" id="showing">
	<div class="mt-5 title text">
		<h2 class="mb-0">PHIM ĐANG CHIẾU</h2>
	</div>
	<div class="w-100 d-flex justify-content-between align-items-center flex-wrap">
		<div class="type-film d-md-flex h-100 justify-content-between align-items-center" style="margin-bottom: 20px;">
			<button type="button" class="btn button-type-film-showing active" id="all-film-showing" style="height: 40px">
				Tất cả
			</button>
			<button type="button" class="btn button-type-film-showing" id="film-3d-showing" style="height: 40px">
				3D
			</button>

		</div>
		<div class="search-box d-flex h-100 align-items-center" style="margin-bottom: 20px; min-height: 50px">
			<i id="search-icon" class="fa-solid fa-magnifying-glass icon d-flex align-items-center" style="padding: 0 10px;"></i>
			<input type="search" name="" id="search-input" placeholder="Tìm kiếm" spellcheck="false" />
		</div>
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