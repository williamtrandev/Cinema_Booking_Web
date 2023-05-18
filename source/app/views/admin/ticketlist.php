<div class="staticFilm">
	<div class="head">
		<h1>Thay đổi giá vé</h1>
	</div>

	<table>
		<thead>
			<th>STT</th>
			<th>Tên loại vé</th>
			<th>Giá</th>
			<th>Thay đổi</th>
		</thead>
		<tbody class="body-revenue">
			<?php
			$i = 1;
			foreach ($data as $item) {
				$price = number_format($item->price, 0, ',', '.');
				echo "<tr>
							<td>$i</td>
							<td>$item->name_loaive</td>
							<td>
								$price
							</td>
							<td>
								<button class='button' class='button' onclick='updateTicket($item->id_loaive)'>
									Thay đổi giá vé
								</button>
							</td>
						</tr>";
				$i++;
			}
			?>
		</tbody>
	</table>
</div>



<div class="modal fade" id="changeTicket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Thay đổi giá vé</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="update-ticket-form">
					<div class="mb-3">
						<label for="message-text" class="col-form-label">Giá:</label>
						<input type="text" class="form-control price-ticket" id="recipient-name" />
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
					Đóng
				</button>
				<button type="button" class="btn btn-primary" onclick="saveChange()">Lưu</button>
			</div>
		</div>
	</div>
</div>

<script>
	function updateTicket(id_loaive) {
		$("#changeTicket").modal("show");
		$("#changeTicket .modal-body").data("ticket", id_loaive);
	}

	function saveChange() {
		let price = $(".price-ticket").val();
		let id_loaive = $("#changeTicket .modal-body").data("ticket");
		console.log(id_loaive);
		console.log(price);
		fetch(`<?php echo _WEB_ROOT ?>/ticket/update/${id_loaive}/${price}`)
			.then(res => res.text())
			.then(data => {
				if (data == 1) {
					alert("Cập nhật thành công");
					setTimeout(() => {
						location.reload();
					}, 1000);
				} else {
					alert("Cập nhật thất bại");
				}
			})
			.catch(err => console.log(err));
	}
</script>