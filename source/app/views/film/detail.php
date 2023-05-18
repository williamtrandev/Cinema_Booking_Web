<div style="height: 10px"></div>
<div class="poster">
	<img class="poster-img" src="<?php echo _WEB_ROOT . "/public/assets/client/img/$data->image_path"; ?>" alt="">
	<div class="poster-footer">
		<b class="name-film"><?php echo $data->name_phim ?></b>
	</div>
</div>
<div class="content">
	<img class="film-img" alt="" src="<?php echo _WEB_ROOT . "/public/assets/client/img/$data->image_path"; ?>" />
	
	<div class="thongtin-film">
		<div class="mt-5 title text">
			<h2 class="mb-0">THÔNG TIN PHIM</h2>
		</div>
		<div class="info m-3">
			<div class="info-daodien">
				<b>Đạo diễn:</b>
				<div class="daodien-detail"><?php echo $data->director ?></div>
			</div>
			<div class="info-dienvien">
				<b>Diễn viên:</b>
				<div class="dienvien-detail">
					<?php echo $data->actors ?>
				</div>
			</div>
			<div class="info-khoichieu">
				<b>Khởi chiếu:</b>
				<div class="khoichieu-detail">
					<?php echo date("d/m/Y", strtotime($data->release_date)) ?>
				</div>
			</div>
		</div>
	</div>
	<div class="trailer-film">
		<div class="mt-5 title text">
			<h2 class="mb-0">TRAILER</h2>
		</div>
		<div class="video-trailer">
			<embed style="width:100%; height:300px;" src="<?php echo $data->trailer_path ?>">
		</div>
	</div>
	<div class="mota-film">
		<div class="mt-5 title text">
			<h2 class="mb-0">MÔ TẢ</h2>
		</div>
		<div class="mota-detail">
			<?php echo $data->description ?>
		</div>
	</div>
</div>
<div class="mb-5">
	<div class="mt-5 title text">
		<h2 class="mb-0">LỊCH CHIẾU</h2>
	</div>
	<div class="container mt-5">
		<script>
			function handleBooking(elem) {
				// let name = $($(elem).closest(".wrapper-suatchieu").find(".title-theater")).text();
				let time = $(elem).text();
				let type = $($(elem).parent().parent().find(".film")).text();
				let date = $($(elem).closest(".cls").find("h3")).text();
				let room = $(elem).data("room");
				let id_showtime = $(elem).data("showtime");
				window.location.href = `<?php echo _WEB_ROOT ?>/booking/index/${time}/${type}/${date}/${id_showtime}/${room}`;
			}
		</script>
		<?php
		if (!empty($suatchieu))
			foreach ($suatchieu as $rap => $dates) {
				echo "<div class='wrapper-suatchieu'>";
				echo "<div class='title-theater text' style='width:fit-content;padding: 15px; border-radius: 10px;'>$rap</div>";
				foreach ($dates as $date => $loaives) {
					$date = date('d-m', strtotime($date));
					echo "<div class='mt-4 cls'>
							<h3 class='text date-choose'>$date</h3>";
					foreach ($loaives as $loaive => $times) {
						$tagspan = strtolower($loaive);
						echo "<div class='my-4'>";
						echo "<div class='film film-$tagspan' style='font-size: 1.2rem; margin-right: 20px'>$loaive</div>";
						echo "<div style='display: flex; flex-wrap: wrap; align-items: center; row-gap: 20px'>";
						foreach ($times as $time) {
							$tg = $time[0];
							$phong = $time[1];
							$id_suatchieu = $time[2];
							echo "<button class='btn btn-showtime' data-room='$phong' data-showtime='$id_suatchieu' onclick='handleBooking(this)'>
								$tg
							</button>";
						}
						echo "</div></div>";
					}
					echo "</div>";
				}
				echo "</div>";
			}
		?>


		<!-- <div class="title-theater text" style="background: var(--primary-color); width:fit-content;padding: 15px; border-radius: 10px;">WillCinema Quận 5</div>
		<div class="mt-4">
			<h3>2D</h3>
			<div class="ngaychieu mb-4">
				<span style="font-size: 1.2rem; margin-right: 20px">17/04</span>
				<button class="btn" href="" style="background: var(--sidebar-color); margin-right: 10px; text-align: center">
					7:30
				</button>
				<button class="btn" href="" style="background: var(--sidebar-color); margin-right: 10px; text-align: center">
					8:30
				</button>
			</div>

			<div class="ngaychieu mb-4">
				<span style="font-size: 1.2rem; margin-right: 20px">18/04</span>
				<button class="btn" href="" style="background: var(--sidebar-color); margin-right: 10px; text-align: center">
					7:30
				</button>
				<button class="btn" href="" style="background: var(--sidebar-color); margin-right: 10px; text-align: center">
					8:30
				</button>
			</div>

			<div class="ngaychieu mb-4">
				<span style="font-size: 1.2rem; margin-right: 20px">19/04</span>
				<button class="btn" href="" style="background: var(--sidebar-color); margin-right: 10px; text-align: center">
					7:30
				</button>
				<button class="btn" href="" style="background: var(--sidebar-color); margin-right: 10px; text-align: center">
					8:30
				</button>
			</div>
		</div>

		<div class="showing-3d mt-4">
			<h3>3D</h3>
			<div class="ngaychieu mb-4">
				<span style="font-size: 1.2rem; margin-right: 20px">17/04</span>
				<button class="btn" href="" style="background: var(--sidebar-color); margin-right: 10px; text-align: center">
					7:30
				</button>
				<button class="btn" href="" style="background: var(--sidebar-color); margin-right: 10px; text-align: center">
					8:30
				</button>
			</div>

			<div class="ngaychieu mb-4">
				<span style="font-size: 1.2rem; margin-right: 20px">18/04</span>
				<button class="btn" href="" style="background: var(--sidebar-color); margin-right: 10px; text-align: center">
					7:30
				</button>
				<button class="btn" href="" style="background: var(--sidebar-color); margin-right: 10px; text-align: center">
					8:30
				</button>
			</div>

			<div class="ngaychieu mb-4">
				<span style="font-size: 1.2rem; margin-right: 20px">19/04</span>
				<button class="btn" href="" style="background: var(--sidebar-color); margin-right: 10px; text-align: center">
					7:30
				</button>
				<button class="btn" href="" style="background: var(--sidebar-color); margin-right: 10px; text-align: center">
					8:30
				</button>
			</div>
		</div> -->
	</div>
</div>