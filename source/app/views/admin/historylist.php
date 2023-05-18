<div class="staticFilm">
	<div class="head">
		<h1>Lịch sử đặt vé</h1>
	</div>

	<table>
		<thead>
			<th>STT</th>
			<th>Tên khách hàng</th>
			<th>Phim</th>
			<th>Suất chiếu</th>
			<th>Số vé đặt</th>
			<th>Tổng tiền</th>
			<th>Ngày đặt</th>
		</thead>
		<tbody class="body-revenue">
			<?php
			$i = 1;
			foreach ($data as $item) {
				$date = date('d-m-Y', strtotime($item->ngaylap));
				$price = number_format($item->total_price, 0, ',', '.');
				echo "<tr>
							<td>$i</td>
							<td>$item->name</td>
							<td>
								$item->name_phim
							</td>
							<td>
								$item->time_show
							</td>
							<td>
								$item->num_ticket
							</td>
							<td>
								$price
							</td>
							<td>
								$date
							</td>
						</tr>";
				$i++;
			}
			?>
		</tbody>
	</table>
	<div class="d-flex justify-content-center w-100">
		<div class="pagination">
			<?php
			$uri = $_SERVER['REQUEST_URI'];
			$lastSlashPos = strrpos($uri, '/');
			$number = substr($uri, $lastSlashPos + 1);
			$pages = ceil($info / 10);
			for ($i = 1; $i <= $pages; $i++) {
				$url = _WEB_ROOT . '/admin/historyList/' . $i;
				$active = $number == $i? 'active' : '';
				echo "<a href='$url' class='$active'>$i</a>";
			}
			?>
		</div>
	</div>
</div>