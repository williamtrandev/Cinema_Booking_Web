<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- MATERIAL CDN -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
	<!-- STYLE SHEET -->
	<link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/client/css/admin.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<title>Quản lý web</title>

</head>

<body>
	<div class="my-container">
		<aside>
			<!-- ===================== SIDEBAR ===================== -->
			<div class="my-sidebar">
				<div class="top">
					<div class="logo">
						<h2><span>WILL CINEMA</span></h2>
					</div>
					<div class="close" id="close-btn">
						<span class="material-icons-sharp">close</span>
					</div>
				</div>
				<a href="#">
					<span class="material-icons-sharp">movie</span>
					<h3>Danh sách phim</h3>
				</a>
				<a href="#">
					<span class="material-icons-sharp">location_on</span>
					<h3>Danh sách rạp</h3>
				</a>
				<a href="#">
					<span class="material-icons-sharp">people</span>
					<h3>Khách hàng</h3>
				</a>
				<a href="#">
					<span class="material-icons-sharp">receipt</span>
					<h3>Lịch sử đặt vé</h3>
				</a>
				<a href="#" class="active">
					<span class="material-icons-sharp">bar_chart</span>
					<h3>Doanh thu</h3>
				</a>
				<a href="<?php echo _WEB_ROOT ?>/user/logout">
					<span class="material-icons-sharp">logout</span>
					<h3>Đăng xuất</h3>
				</a>
			</div>
		</aside>

		<!-- ===================== MAIN ===================== -->
		<main>
			<h1>Doanh thu</h1>
			<div class="wrapper-date-user">
				<div class="date">
					<input type="date">
				</div>
				<div class="top">
					<button id="menu-btn">
						<span class="material-icons-sharp">menu</span>
					</button>
					<div class="theme-toggler">
						<span class="material-icons-sharp active">light_mode</span>
						<span class="material-icons-sharp">dark_mode</span>
					</div>
					<div class="profile d-md-flex align-items-center">
						<div class="info">
							<p>Chào, <b><?php echo json_decode($_SESSION['user'])->name ?></b></p>
						</div>
						<div class="profile-photo">
							<img src="<?php echo _WEB_ROOT; ?>/public/assets/client/img/user.png">
						</div>
					</div>
				</div>
			</div>

			<div class="insights">
				<div class="totalSale">
					<span class="material-icons-sharp">assessment</span>
					<div class="middle">
						<div class="left">
							<h3 class="text-total">Tổng tiền thu được</h3>
							<h1>34.650.000 VNĐ</h1>
						</div>
					</div>
				</div>

				<div class="ticketSale">
					<span class="material-icons-sharp">confirmation_number</span>
					<div class="middle">
						<div class="left">
							<h3 class="text-total">Tổng tiền thu được từ vé</h3>
							<h1>34.650.000 VNĐ</h1>
						</div>
					</div>
				</div>

				<div class="foodSale">
					<span class="material-icons-sharp">fastfood</span>
					<div class="middle">
						<div class="left">
							<h3 class="text-total">Tổng tiền thu được từ đồ ăn</h3>
							<h1>34.650.000 VNĐ</h1>
						</div>
					</div>
				</div>
			</div>
			<!-- ===================== THỐNG KÊ THEO PHIM ===================== -->
			<div class="staticFilm">
				<h1>Doanh thu theo phim</h1>
				<table>
					<thead>
						<th>STT</th>
						<th>Phim</th>
						<th>Tổng số vé</th>
						<th>Tổng tiền(VNĐ)</th>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Ant-Man and the Wasp: QUANTUMANIA</td>
							<td>103</td>
							<td class="total">7.725.000</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Mất tích</td>
							<td>100</td>
							<td class="total">7.500.000</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Nhà bà nữ</td>
							<td>92</td>
							<td class="total">6.900.000</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Thánh vật của quỷ</td>
							<td>70</td>
							<td class="total">5.250.000</td>
						</tr>
						<tr>
							<td>5</td>
							<td>Chị chị em em</td>
							<td>52</td>
							<td class="total">4.050.000</td>
						</tr>
						<tr>
							<td>6</td>
							<td>Phi vụ đào mỏ</td>
							<td>23</td>
							<td class="total">1.725.000</td>
						</tr>
						<tr>
							<td>7</td>
							<td>Vong nhi</td>
							<td>20</td>
							<td class="total">1.500.000</td>
						</tr>
					</tbody>
				</table>
				<a href="#">Xem tất cả</a>
			</div>
		</main>
	</div>

	<script src="<?php echo _WEB_ROOT; ?>/public/assets/client/js/admin.js"></script>

</body>

</html>