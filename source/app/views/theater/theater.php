<div class="title text">
	<h2 class="mb-0">Hệ thống rạp</h2>
</div>

<div class="history-user">
	<table class="content-table">
		<thead>
			<tr>
				<th>STT</th>
				<th>Tên rạp</th>
				<th>Địa chỉ</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$i = 1;
				foreach($data as $item) {
					echo '<tr>';
                        echo '<td>'. $i. '</td>';
                        echo '<td>'. $item->name. '</td>';
                        echo '<td>'. $item->address. '</td>';
                    echo '</tr>';
					$i++;
                }
			?>

		</tbody>
	</table>
</div>
