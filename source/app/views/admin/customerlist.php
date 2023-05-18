<div class="staticFilm">
	<div class="head">
		<h1>Doanh sách khách hàng</h1>
	</div>

	<table>
		<thead>
			<th>STT</th>
			<th>Tên khách hàng</th>
			<th>Địa chỉ</th>
			<th>Số điện thoại</th>
			<th>Ngày sinh</th>
			<th>Tích điểm</th>
		</thead>
		<tbody class="body-revenue">
			<?php
				$pages = ceil($info/10);
				foreach($data as $item) {
					$date = date('d-m-Y', strtotime($item->birthday));
					echo "<tr>
							<td>$item->id_khachhang</td>
							<td>$item->name</td>
							<td>
								$item->email
							</td>
							<td>
								$item->phone
							</td>
							<td>
								$date
							</td>
							<td>
								$item->point
							</td>
						</tr>";
				}
			?>
		</tbody>
	</table>
	<div class="pagination d-flex justify-content-center">
	<?php
		$uri = $_SERVER['REQUEST_URI'];
		$lastSlashPos = strrpos($uri, '/');
		$number = substr($uri, $lastSlashPos + 1);
		for($i = 1; $i <= $pages; $i++) {
			$active = $number == $i ? 'active' : '';
			$url = _WEB_ROOT . '/admin/customerList/' . $i;
			echo "<a href='$url' class='$active'>$i</a>";
		}
	?>
	</div>
</div>