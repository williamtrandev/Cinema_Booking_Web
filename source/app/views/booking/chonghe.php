<div class="steps d-flex justify-content-md-end justify-content-between container">
	<p class="step active">
		<span>01</span> CHỌN GHẾ
	</p>
	<p class="step">
		<span>02</span> CHỌN BẮP NƯỚC VÀ THANH TOÁN
	</p>
</div>
<div class="container d-flex justify-content-between">
	<!-- <div class="card-choose">
                    <div class="img-poster">
                        <img src="./assets/ant.jpg" alt="">
                    </div>
                    <div class="card-desc">
                        <h5>Đạo diễn</h5>
                        <p class="fw-light">Peyton Reed</p>
                        <h5>Diễn viên</h5>
                        <p>Paul Rudd, Jonathan Majors, Evangeline Lilly</p>
                    </div>
                </div> -->
	<div class="chonkhunggiovaghe position-relative">
		<div class="time">
			<div class="wrapper-title-chon-phim d-flex flex-md-row justify-content-between align-items-center">
				<h3><?php echo $data->name_phim ?></h3>
				<div class="time-and-type d-flex flex-md-row align-items-center">
					<div class="time-duration-phim d-flex justify-content-center align-items-center me-3">
						<i class="fa-solid fa-clock" style="font-size: 1.5rem; margin-right: 10px;"></i>
						<span class="time-minutes" style="font-size: 1.1rem;"><?php echo $data->duration ?> phút</span>
					</div>
					<div class="type-phim-btn d-flex justify-content-center align-items-center" style="font-size: 1.1rem;"><?php echo $data->name_nhanphim ?></div>
				</div>
			</div>
			<div class="wrapper-khunggio-and-showtime d-flex flex-column flex-md-row  justify-content-between">
				<div class="khunggio">
					<p class="pb-2 text-center" style="font-size: 1.2rem;">Ngày chiếu: <?php echo $_SESSION['date-booking'] ?></p>
				</div>
				<div class="showtime">
					<p class="pb-2 text-center" style="font-size: 1.2rem;"><span style="margin-right:20px;">Loại vé: <?php echo $_SESSION['type-booking'] ?></span> <span>Giờ chiếu: <?php echo $_SESSION['time-booking'] ?></span></p>
				</div>
			</div>
		</div>

		<!-- Màn hình và ghế -->
		<div class="screen-and-seat position-relative">
			<div class="screen w-100 my-md-5 position-relative" style="height: 80px; background: url(<?php echo _WEB_ROOT?>/public/assets/img/Screen.png); background-size: contain; background-position: center; background-repeat: no-repeat;">
			</div>
			<div class="seats container-fluid">
				<?php
				function intToChar($num)
				{
					$code = ord('A');
					return chr($code + $num);
				}
				$row = 0;
				$id_sc = $_SESSION['id-booking'];
				foreach ($ghe as $item) {
					$id = $item->id_ghe;
					$hangghe = $item->hangghe;
					$vitri = $item->vitri;
					$trangthai = ($item->trangthai == 1) ? "sold" : "";
					if ($vitri == 1) {	// Vị trí = 0 báo hiệu bắt đầu hàng mới
						echo "<div class='row-seat mt-2'>";
						$charRow = intToChar($row);
						echo "<div class='col-seat-name' style='width: 30px; cursor: default;'><span class='text w-100 h-100 d-flex justify-content-center align-items-center'>" . $charRow . "</span></div>";
						echo "<div class='col-seat' ><div class='seat w-100 $trangthai' data-row='$hangghe' data-pos='$vitri' data-ghe='$id' data-show='$id_sc' style='padding-bottom: 100%' choose='false'></div></div>";
					} else if ($vitri == 4 || $vitri == 10) {
						echo "<div class='col-seat' ><div class='seat w-100 $trangthai' data-row='$hangghe' data-pos='$vitri' data-ghe='$id' data-show='$id_sc' style='padding-bottom: 100%' choose='false'></div></div>";
						echo "<div class='col-seat'></div>";
					} else if ($vitri == 14) {
						echo "<div class='col-seat' ><div class='seat w-100 $trangthai' data-row='$hangghe' data-pos='$vitri' data-ghe='$id' data-show='$id_sc' style='padding-bottom: 100%' choose='false'></div></div>";
						$charRow = intToChar($row);
						echo "<div class='col-seat-name' style='width: 30px; cursor: default;'><span class='text w-100 h-100 d-flex justify-content-center align-items-center'>" . $charRow . "</span></div>";
						$row++;
						echo "</div>";
					} else {
						echo "<div class='col-seat' ><div class='seat w-100 $trangthai' data-row='$hangghe' data-pos='$vitri' data-ghe='$id' data-show='$id_sc' style='padding-bottom: 100%' choose='false'></div></div>";
					}
				}
				?>
			</div>
			<div class="desc-seat w-100 d-flex justify-content-around justify-content-md-center mt-5 position-relative">
				<div class="choosing-desc-seat d-flex justify-content-center align-items-center me-md-5" style="cursor: default !important;">
					<div class="col-seat me-3">
						<div class="w-100" style="background-color: #FF6A6A;padding-bottom: 100%; margin-right: 10px; cursor: default;border-radius: 5px;cursor: pointer;"></div>
					</div>
					<span class="text">Đang chọn</span>
				</div>
				<div class="booking-desc-seat d-flex justify-content-center align-items-center me-md-5" style="cursor: default !important;">
					<div class="col-seat me-3">
						<div class="w-100" style="padding-bottom: 100%; margin-right: 10px; cursor: default;background-color: #B5B5B5;border-radius: 5px;cursor: pointer;"></div>
					</div>
					<span class="text">Ghế đơn</span>
				</div>
				<div class="sold-desc-seat d-flex justify-content-center align-items-center me-md-5" style="cursor: default !important;">
					<div class="col-seat me-3">
						<div class="w-100" style="background-color: #695CFE;padding-bottom: 100%; margin-right: 10px; cursor: default;border-radius: 5px;cursor: pointer;"></div>
					</div>
					<span class="text">Đã bán</span>
				</div>
			</div>
		</div>
		<script>
			function intToChar(num) {
				const code = 'A'.charCodeAt(0);
				return String.fromCharCode(code + num);
			}

			function handleChonGhe() {
				let gheDaChon = [];
				let gheHienThi = [];
				$(".seat.choosing").each(function() {
					let row = $(this).attr("data-row");
					let pos = $(this).attr("data-pos");
					let id_ghe = $(this).attr("data-ghe");
					let id_suatchieu = $(this).attr("data-show");
					gheDaChon.push({
						"id_ghe": id_ghe,
						"id_suatchieu": id_suatchieu,
					});
					gheHienThi.push(intToChar(parseInt(row - 1)) + pos);
				})
				if (gheDaChon.length > 0) {
					// Gửi dữ liệu qua cho trang chọn bắp nước
					sessionStorage.setItem("gheDaChon", JSON.stringify(gheDaChon));
					sessionStorage.setItem("gheHienThi", gheHienThi);
					window.location.href = '<?php echo _WEB_ROOT ?>/booking/chooseFoods';
				} else {
					alert("Vui lòng chọn ghế");
				}
			}
		</script>
		<div class="next-step d-flex justify-content-center align-items-center" style="cursor: pointer;" onclick="handleChonGhe()">
			<i class="fa-solid fa-arrow-right" style="color: white; font-size: 1.2rem;"></i>
		</div>
	</div>

</div>