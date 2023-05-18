<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- MATERIAL CDN -->
	<link rel="icon" href="<?php echo _WEB_ROOT; ?>/public/assets/server/img/favicon.ico" type="image/x-icon">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" />
	<!-- STYLE SHEET -->
	<link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/client/css/admin.css">
	<link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/client/css/movieAdmin.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<title><?php echo $title_page ?></title>
	<script>
		$(function() {
			fetch(`<?php echo _WEB_ROOT ?>/admin/getAllFilmHistory`)
				.then(res => res.json())
				.then(data => {
					let totalPages = Math.ceil(data / 10);
					$(".pagination-revenue").append($('<a></a>').text(1).attr('href', '#').addClass("active"));
					for (let i = 2; i <= totalPages; i++) {
						$(".pagination-revenue").append($('<a></a>').text(i).attr('href', '#'));
					}
				});
			$("input[type='date']").change(function() {
				let start = $("#date-start").val();
				let end = $("#date-end").val();
				console.log(start);
				if (start && end) {
					fetch(`<?php echo _WEB_ROOT ?>/admin/getTotalRevenue/${start}/${end}`)
						.then(res => res.json())
						.then(data => {
							$(".total-revenue").text(data.toLocaleString('vi-VN') + " VND")
						});
					fetch(`<?php echo _WEB_ROOT ?>/admin/getInfoRevenue/${start}/${end}`)
						.then(res => res.json())
						.then(data => {
							let i = 1;
							$(".body-revenue").children().remove();
							data.forEach(element => {
								let tongtien = parseInt(element.tongtien).toLocaleString('vi-VN');
								$(".body-revenue").append(
									`<tr>
									<td>${i}</td>
									<td>${element.name_phim}</td>
									<td>${element.soluong}</td>
									<td class="total">${tongtien}</td>
								</tr>`
								);
								i++;
							});
						})
				}
			})
		})
	</script>
</head>

<body>
	<div class="my-container">
		<aside>
			<!-- ===================== SIDEBAR ===================== -->
			<div class="my-sidebar">
				<div class="top">
					<div class="logo">
						<div style="width: 50px; height: 50px; border-radius: 10px; background-color: #695cfe; color: #f6f5ff; font-weight: 600; display: flex; justify-content: center; align-items: center; font-size: 1.4rem">W</div>
						<h2><span>WILL CINEMA</span></h2>
					</div>
					<div class="close" id="close-btn">
						<span class="material-icons-sharp">close</span>
					</div>
				</div>
				<a href="<?php echo _WEB_ROOT ?>/admin/ticketList">
					<span class="material-icons-sharp">local_activity</span>
					<h3>Thay đổi giá vé</h3>
				</a>
				<a href="<?php echo _WEB_ROOT ?>/admin/filmList">
					<span class="material-icons-sharp">movie</span>
					<h3>Danh sách phim</h3>
				</a>
				<a href="<?php echo _WEB_ROOT ?>/admin/theaterList">
					<span class="material-icons-sharp">location_on</span>
					<h3>Danh sách rạp</h3>
				</a>
				<a href="<?php echo _WEB_ROOT ?>/admin/foodList">
					<span class="material-icons-sharp">fastfood</span>
					<h3>Quản lý món ăn</h3>
				</a>

				<a href="<?php echo _WEB_ROOT ?>/admin/customerList/1">
					<span class="material-icons-sharp">people</span>
					<h3>Khách hàng</h3>
				</a>
				<a href="<?php echo _WEB_ROOT ?>/admin/historyList/1">
					<span class="material-icons-sharp">receipt</span>
					<h3>Lịch sử đặt vé</h3>
				</a>
				<a href="<?php echo _WEB_ROOT ?>/admin">
					<span class="material-icons-sharp">bar_chart</span>
					<h3>Doanh thu</h3>
				</a>
				<a href="<?php echo _WEB_ROOT ?>/user/logout">
					<span class="material-icons-sharp">logout</span>
					<h3>Đăng xuất</h3>
				</a>
			</div>
		</aside>
		<main>
			<div class="wrapper-date-user">

				<div class=" top">
					<button id="menu-btn">
						<span class="material-icons-sharp">menu</span>
					</button>
					<div class="theme-toggler">
						<span class="material-icons-sharp active">light_mode</span>
						<span class="material-icons-sharp">dark_mode</span>
					</div>
					<div class="profile d-md-flex align-items-center">
						<div class="info d-flex align-items-center">
							<span style="color: var(--color-dark)">Chào,</span> <b><?php echo json_decode($_SESSION['user'])->name ?></b>
						</div>
						<div class="profile-photo">
							<img src="<?php echo _WEB_ROOT; ?>/public/assets/client/img/user.png">
						</div>
					</div>
				</div>
			</div>

			<?php
			if (!isset($info))
				$info = '';
			$this->render($content, ['data' => $data_pass, 'info' => $info]);
			?>


	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo _WEB_ROOT; ?>/public/assets/client/js/admin.js"></script>

</body>

</html>