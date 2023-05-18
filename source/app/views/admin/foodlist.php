<div class="staticFilm">
	<div class="head">
		<h1>Doanh sách món ăn</h1>
		<button class="button" data-bs-toggle="modal" data-bs-target="#addFood">
			Thêm món ăn
		</button>
	</div>


	<table>
		<thead>
			<th>STT</th>
			<th>Tên món ăn</th>
			<th>Mô tả</th>
			<th>Giá</th>
			<th>Hình ảnh</th>
			<th>Hành động</th>
		</thead>
		<tbody>
			<?php
			$i = 1;
			foreach ($data as $item) {
				$price = number_format($item->price, 0, ',', '.');
				$detail = $item->detail == '' ? '-' : $item->detail;
				echo "<tr>
						<td>$i</td>
						<td class='total'>$item->name</td>
						<td>
							$detail
						</td>
						<td>$price</td>
						<td>$item->image_path</td>
						<td>
							<button class='button' class='button' data-bs-toggle='modal' data-bs-target='#exampleModal' data-bs-whatever='@getbootstrap' data-name='$item->name' data-detail='$item->detail' data-price='$item->price' onclick='handleEdit(this, $item->id_combo)'>
								Sửa món ăn
							</button>
						</td>
					</tr>";
				$i++;
			}

			?>
		</tbody>
	</table>
</div>

</main>
<!-- ============= FORM SUA MON AN ============= -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Sửa món ăn</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body modal-food-body">
				<form method="post" enctype="multipart/form-data" class="upload-food-form">
					<div class="mb-3">
						<label for="recipient-name" class="col-form-label">Tên món ăn:</label>
						<input type="text" class="form-control" id="recipient-name" name="name" />
					</div>
					<div class="mb-3">
						<label for="message-text" class="col-form-label">Mô tả:</label>
						<input type="text" class="form-control" id="recipient-name" name="detail" />
					</div>
					<div class="mb-3">
						<label for="message-text" class="col-form-label">Giá:</label>
						<input type="text" class="form-control" id="recipient-name" name="price" />
					</div>
					<div class="mb-3">
						<label for="message-text" class="col-form-label">Hình ảnh:</label>
						<input type="file" accept="image/*" class="form-control" id="message-text" name="image_path" />
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
					Đóng
				</button>
				<button type="button" class="btn btn-primary" onclick="updateFood()">Lưu</button>
				<button type="button" class="btn btn-danger" onclick="removeFood()">Xóa</button>
			</div>
		</div>
	</div>
</div>
<!-- ============= FORM THEM MON AN ============= -->
<div class="modal fade" id="addFood" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Thêm món ăn</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form method="post" enctype="multipart/form-data" class="upload-food-form-add">
					<div class="mb-3">
						<label for="recipient-name" class="col-form-label">Tên món ăn:</label>
						<input type="text" class="form-control" id="recipient-name" name="name-add" />
					</div>
					<div class="mb-3">
						<label for="message-text" class="col-form-label">Mô tả:</label>
						<input type="text" class="form-control" id="recipient-name" name="detail-add" />
					</div>
					<div class="mb-3">
						<label for="message-text" class="col-form-label">Giá:</label>
						<input type="text" class="form-control" id="recipient-name" name="price-add" />
					</div>
					<div class="mb-3">
						<label for="message-text" class="col-form-label">Hình ảnh:</label>
						<input type="file" accept="image/*" class="form-control" id="message-text" name="image_path-add" />
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
					Đóng
				</button>
				<button type="button" class="btn btn-primary" onclick="insertFood()">Lưu</button>
			</div>
		</div>
	</div>
</div>
<script>
	function handleEdit(elem, id) {
		$("input[name='name']").val($(elem).data("name"));
		$("input[name='detail']").val($(elem).data("detail"));
		$("input[name='price']").val($(elem).data("price"));
		$(".modal-food-body").data("id_combo", id);
	}

	function updateFood() {
		const form = document.querySelector('.upload-food-form');
		const formData = new FormData(form);
		formData.append("id_combo", $(".modal-food-body").data("id_combo"));
		fetch('<?php echo _WEB_ROOT ?>/food/update', {
				method: 'POST',
				body: formData,
			})
			.then(res => res.text())
			.then(data => {
				if (data == 1) {
					alert('Cập nhật thông tin thành công');
					setTimeout(() => {
						location.reload();
					}, 1000);
				} else {
					alert("Cập nhật không thành công");
				}
			})
			.catch(err => {
				alert('Upload failed');
			})

	}

	function removeFood() {
		let id_combo = $(".modal-food-body").data("id_combo");
		fetch(`<?php echo _WEB_ROOT ?>/food/delete/${id_combo}`)
			.then(res => res.text())
			.then(data => {
				if (data == 1) {
					alert('Xóa thành công');
					setTimeout(() => {
						location.reload();
					}, 1000);
				} else {
					alert("Xóa không thành công");
				}
			})
			.catch(err => {
				alert('Upload failed');
			})
	}

	function insertFood() {
		const form = document.querySelector('.upload-food-form-add');
		const formData = new FormData(form);
		fetch('<?php echo _WEB_ROOT ?>/food/insert', {
				method: 'POST',
				body: formData,
			})
			.then(res => res.text())
			.then(data => {
				console.log(data);
				if (data == 1) {
					alert('Thêm món ăn thành công');
					setTimeout(() => {
						location.reload();
					}, 1000);
				} else {
					alert("Không thành công");
				}
			})
			.catch(err => {
				alert('Upload failed');
			})
	}
</script>