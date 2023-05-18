<div class="steps d-flex justify-content-md-end justify-content-between container">
	<p class="step">
		<span>01</span> CHỌN GHẾ
	</p>
	<p class="step active">
		<span>02</span> CHỌN BẮP NƯỚC VÀ THANH TOÁN
	</p>
</div>
<div class="container d-flex justify-content-md-between flex-column flex-md-row align-items-center">
	<div class="card-choose">
		<div class="card-title-film card-item-ticket">
			<h4 style="color: white; font-weight: bold;"><?php echo $thongtindat->name_phim ?></h4>
			<div class="type-phim-btn d-flex justify-content-center align-items-center" style="font-size: 1.1rem;"><?php echo $thongtindat->name_nhanphim ?></div>
		</div>
		<div class="card-desc card-item-ticket">
			<p class="sub-title-card-item-ticket">Thông tin vé</p>
			<p>Giá mỗi vé: <span class="price-ticket"><?php echo number_format($thongtindat->price, 0, ",", ".") ?></span></p>
			<p>Thời gian: <span><?php echo date("d-m-Y", strtotime($thongtindat->date_show));?></span></p>
			<p>Suất chiếu: <span><?php echo $thongtindat->time_show ?></span></p>
			<p>Rạp: <span><?php echo $thongtindat->name.", ".$thongtindat->name_phongchieu ?></span></p>
			<p>Loại vé: <span><?php echo $thongtindat->name_loaive ?></span></p>
			<p>Ghế: <span class="ghe"></span></p>
		</div>
		<div class="card-desc card-item-ticket">
			<p class="sub-title-card-item-ticket">Thông tin sản phẩm</p>
			<p id="product-buying"></p>
		</div>
		<div class="card-item-ticket">
			<p class="sub-title-card-item-ticket">Tổng: <span class="price-total-ticket"></span></p>
		</div>
	</div>
	<div class="foods-and-drinks position-relative">
		<h3 class="text">Đặt hàng sản phẩm</h3>
		<div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative;">
			<table class="table mb-0 text-center">
				<thead style="background-color: #696969;">
					<tr>
						<th scope="col">Combo</th>
						<th scope="col">Số lượng</th>
						<th scope="col">Giá (VND)</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($data as $item) {
						$price = number_format($item->price, 0, ",", ".");
						echo "<tr>
						<td>
							<div class='d-flex justify-content-center'>
								<div class='wrapper-product'>
									<img src='" . _WEB_ROOT . "/public/assets/server/img/$item->image_path' alt=''>
									<div class='wrapper-product-detail'>
										<span style='font-weight: bold; color: black' class='name-product' id='f$item->id_combo'>$item->name</span>
										<span>$item->detail</span>
									</div>
								</div>
							</div>
						</td>
						<td>
							<div class='wrapper-product'>
								<div class='minus-product action-product disabled'>-</div>
								<input type='number' value='0' readonly class='num-product'>
								<div class='add-product action-product'>+</div>
							</div>
						</td>
						<td>
							<div class='wrapper-product'>$price</div>
						</td>
					</tr>";
					}
					?>

				</tbody>
			</table>
		</div>
		<div class="next-step d-flex justify-content-center align-items-center" style="cursor: pointer;" id="checkout">
			<i class="fa-solid fa-arrow-right" style="color: white; font-size: 1.2rem;"></i>
		</div>
	</div>
</div>