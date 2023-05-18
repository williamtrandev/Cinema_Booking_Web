<div class="staticFilm">
	<div class="head">
		<h1>Doanh sách rạp</h1>
		<button class="button" onclick="$('.modal-add-rap').modal('show')">
			Thêm rạp
		</button>
	</div>


	<table>
		<thead>
			<th>STT</th>
			<th>Phim</th>
			<th>Địa chỉ</th>
			<th></th>
		</thead>
		<tbody>
			<script>
				function loadSuatChieu(id) {
					// Lấy hết suất chiếu theo rạp show ra
					fetch(`<?php echo _WEB_ROOT ?>/admin/getAllSuatChieuByRap/${id}`)
						.then(res => res.json())
						.then(data => {
							let tr = "";
							let i = 1;
							$(".modal-theater .modal-body tbody").children().remove();
							data.forEach(element => {
								let dateStr = element.date_show;
								let dateArr = dateStr.split('-');
								let newDateStr = dateArr[2] + '-' + dateArr[1] + '-' + dateArr[0];
								let loaive = element.phim_3d == 1 ? '3D' : '2D';
								tr += `<tr>
									<td>${i}</td>
									<td class="fw-bold">${element.name_phim}</td>
									<td class="fw-bold">${loaive}</td>
									<td class="fw-bold">${element.time_show}</td>
									<td class="fw-bold">${newDateStr}</td>
									<td class="fw-bold">${element.name_phongchieu}</td>
									<td class="d-flex justify-content-center">
										<button class="btn btn-danger btn-delete-sc" onclick="handleConfirmRemove(${element.id_suatchieu}, ${element.id_rap})">Xóa</button>
									</td>
								</tr>`;
								i++;
							});
							$(".modal-theater .modal-body tbody").append(tr);

						})
						.catch(err => console.log(err));
				}

				// Hàm gọi fetch API để hiện tất cả phòng chiếu
				function loadPhongChieu(id) {
					fetch(`<?php echo _WEB_ROOT ?>/showroom/index/${id}`)
						.then(res => res.json())
						.then(data => {
							let tr = "";
							let i = 1;
							$(".modal-add .modal-body tbody").children().remove();
							data.forEach(element => {
								tr += `<tr>
									<td>${i}</td>
									<td class="fw-bold">${element.name_phongchieu}</td>
									<td class="fw-bold">${element.sohang}</td>
								</tr>`;
								i++;
							});
							$(".modal-add .modal-body tbody").append(tr);
						})
						.catch(err => console.log(err));
				}

				function themPhong() {
					let id = $(".modal-add .modal-body").data("id_rap");
					let name = $(".name-add-pc").val();
					let num = $(".row-add-pc").val();
					if (name && num) {
						fetch(`<?php echo _WEB_ROOT ?>/showroom/insert/${name}/${num}/${id}`)
							.then(res => res.text())
							.then(data => {
								if (data == 1) {
									loadPhongChieu(id);
									alert("Thêm phòng chiếu thành công");
									setTimeout(() => {
										location.reload();
									}, 1000);
								} else {
									alert("Thêm phòng chiếu thất bại");
								}
							});
					} else {
						alert("Chưa nhập đủ thông tin");
					}

				}
				// Hàm gọi fetch API để thêm phòng
				function handleFetchThemPhong(elem, id) {
					loadPhongChieu(id);
					$(".modal-add").modal("show");
					$(".modal-add .modal-body").data("id_rap", id);
				}

				function themSuatChieu() {
					let id = $(".modal-theater .modal-body").data("id_rap");
					let id_phim = $(".select-phim").val();
					let duration_check = 0;
					if (id_phim) {
						fetch(`<?php echo _WEB_ROOT ?>/film/getDuration/${id_phim}`)
							.then(res => res.json())
							.then(data => {
								duration_check = data.duration;
								let suatchieu_check = $("#time-show").val();
								let phongchieu_check = $(".select-phong").val();
								let ngaychieu_check = $("#date-show").val();
								// Gọi fetch API để kiểm tra xem có bị cấn lịch không, nếu có thì không insert
								// ngược lại thì insert vào
								if (suatchieu_check && phongchieu_check && ngaychieu_check && ngaychieu_check) {
									fetch(`<?php echo _WEB_ROOT ?>/showtime/checkTrungSuatChieu/${suatchieu_check}/${phongchieu_check}/${ngaychieu_check}/${duration_check}`)
										.then(res => res.json())
										.then(data => {
											if (data.kq == 1) {
												let loaive = $(".select-loaive").val();
												fetch(`<?php echo _WEB_ROOT ?>/showtime/insert/${id_phim}/${id}/${loaive}/${phongchieu_check}/${ngaychieu_check}/${suatchieu_check}`)
													.then(res => res.text())
													.then(data => {
														if (data == 1) {
															alert("Thêm thành công");
															loadSuatChieu(id);
															// setTimeout(() => {
															// 	location.reload();
															// }, 1000);
														}
													})
													.catch(err => console.log(err))
											} else {
												alert("Đã có suất chiếu sử dụng phòng trong khoảng thời gian này");
											}
										})
										.catch(err => console.log(err));
								} else {
									alert("Vui lòng chọn và nhập đủ thông tin");
								}
							})
							.catch(err => console.log(err))
					}
				}
				// Hàm gọi fetch API để thêm suất chiếu
				function handleFetch(elem, id) {
					loadSuatChieu(id);
					$(".modal-theater .modal-body").data("id_rap", id);
					// Lấy tất cả phim đang chiếu để vào select
					fetch(`<?php echo _WEB_ROOT ?>/admin/getAllFilmShowing`)
						.then(res => res.json())
						.then(data => {
							$(".modal-theater .modal-body .select-phim").children().remove();
							let select = "";
							data.forEach(element => {
								select += `<option value="${element.id_phim}">${element.name_phim}</option>`
							});
							$(".modal-theater .modal-body .select-phim").append(`<option value="" selected disabled>Chọn</option>`);
							$(".modal-theater .modal-body .select-phim").append(select);
						})
						.catch(err => console.log(err));
					// Lấy tất cả các phòng hiển thị ra select
					fetch(`<?php echo _WEB_ROOT ?>/showroom/index/${id}`)
						.then(res => res.json())
						.then(data => {
							$(".modal-theater .modal-body .select-phong").children().remove();
							let select = "";
							data.forEach(element => {
								select += `<option value="${element.id_phongchieu}" data-row="${element.sohang}">${element.name_phongchieu}</option>`
							});
							$(".modal-theater .modal-body .select-phong").append(`<option value="" selected disabled>Chọn</option>`);
							$(".modal-theater .modal-body .select-phong").append(select);
						})
						.catch(err => console.log(err));


					$(".modal-theater").modal("show");
				}

				// Hàm gọi fetch API để thêm rạp
				function handleFetchThemRap() {
					let name = $(".name-add-rap").val();
					let address = $(".address-add-rap").val();
					if (name && address) {
						fetch(`<?php echo _WEB_ROOT ?>/theater/insert/${name}/${address}`)
							.then(res => res.text())
							.then(data => {
								if (data == 1) {
									alert("Thêm thành công");
									// Load lại trang sau 2s khi thêm thành công
									// setTimeout(() => {
									// 	location.reload();
									// }, 2000);
								} else {
									alert("Thất bại");
								}
							})
					} else {
						alert("Vui lòng nhập đủ thông tin");
					}
				}

				function xoaSuatChieu() {
					let id_suatchieu = $('#confirmDeleteModal .modal-body').data("sc");
					let id_rap = $('#confirmDeleteModal .modal-body').data("rap");
					$("#confirmDeleteModal").modal('hide');
					fetch(`<?php echo _WEB_ROOT ?>/showtime/delete/${id_suatchieu}`)
						.then(res => res.text())
						.then(data => {
							if (data == 1) {
								alert("Xóa thành công");
								loadSuatChieu(id_rap);
								// setTimeout(() => {
								// 	location.reload();
								// }, 1000);
							} else {
								alert("Không thành công");
							}
						})
						.catch(err => console.log(err));
				}
				// Hàm xác nhận xóa suát chiếu, nếu đồng ý thì xóa
				function handleConfirmRemove(id_suatchieu, id_rap) {
					console.log($("#confirmDeleteModal"));
					$("#confirmDeleteModal").modal('show');
					$('#confirmDeleteModal .modal-body').data("sc", id_suatchieu);
					$('#confirmDeleteModal .modal-body').data("rap", id_rap);

				}
			</script>
			<?php
			$i = 1;
			foreach ($data as $item) {
				echo "<tr>
							<td>$i</td>
							<td class='total'>$item->name</td>
							<td>
								$item->address
							</td>
							<td>
								<button class='button' class='button' data-name='$item->name' onclick='handleFetch(this, $item->id_rap)'>
									Thêm suất chiếu
								</button>
								<button class='button' class='button' onclick='handleFetchThemPhong(this, $item->id_rap)'>
									Thêm phòng chiếu
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
<div class="modal fade modal-theater" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">
					Thêm suất chiếu
				</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<h3>Lịch chiếu</h3>

				<table class="text-center w-100">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên phim</th>
							<th>Loại vé</th>
							<th>Giờ chiếu</th>
							<th>Ngày chiếu</th>
							<th>Phòng</th>
							<th>Hành động</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>

				<form>
					<div class="mb-3">
						<label for="recipient-name" class="col-form-label">Phim:</label>
						<select name="" id="" class="form-control select-phim">

						</select>
					</div>
					<div class="mb-3">
						<label for="loaive-name" class="col-form-label">Loại vé:</label>
						<select name="" id="loaive" class="form-control select-loaive">
							<option value="1">2D</option>
							<option value="2">3D</option>
						</select>
					</div>
					<div class="mb-3">
						<label for="message-text" class="col-form-label">Phòng:</label>
						<select class="form-control select-phong" id="message-text">

						</select>
					</div>

					<div class="mb-3">
						<label for="time-show" class="col-form-label">Suất chiếu:</label>
						<input type="text" id="time-show" class="form-control" pattern="^(0?[1-9]|1[0-2]):([0-5][0-9])( [AaPp][Mm])?$" required />

					</div>
					<div class="mb-3">
						<label for="date-show" class="col-form-label">Ngày chiếu:</label>
						<input type="date" id="date-show" class="form-control" required />
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
					Đóng
				</button>
				<button type="button" class="btn btn-primary save-showtime-btn" onclick="themSuatChieu()">Lưu</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade modal-add" id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">
					Thêm phòng chiếu
				</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<h3>Danh sách phòng</h3>

				<table class="text-center w-100">
					<thead>
						<tr>
							<th>STT</th>
							<th>Phòng chiếu</th>
							<th>Số hàng</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>

				<form>
					<div class="mb-3">
						<label for="recipient-name" class="col-form-label">Tên phòng chiếu:</label>
						<input type="text" class="form-control name-add-pc">
					</div>
					<div class="mb-3">
						<label for="" class="col-form-label">Số hàng ghế:</label>
						<input type="number" class="form-control row-add-pc">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
					Đóng
				</button>
				<button type="button" class="btn btn-primary" id="add-room-btn" onclick="themPhong()">Lưu</button>
			</div>

		</div>
	</div>
</div>


<div class="modal fade modal-add-rap" id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">
					Thêm rạp
				</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form>
					<div class="mb-3">
						<label for="recipient-name" class="col-form-label">Tên rạp:</label>
						<input type="text" class="form-control name-add-rap">
					</div>
					<div class="mb-3">
						<label for="" class="col-form-label">Địa chỉ:</label>
						<input type="text" class="form-control address-add-rap">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
					Đóng
				</button>
				<button type="button" class="btn btn-primary add-rap-btn" onclick="handleFetchThemRap()">Lưu</button>
			</div>

		</div>
	</div>
</div>
<!-- Modal xác nhận xóa -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="confirmDeleteModalLabel">Xác nhận xóa</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				Bạn có chắc chắn muốn xóa?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
				<button id="confirmDeleteButton" type="button" class="btn btn-danger" onclick="xoaSuatChieu()">Xóa</button>
			</div>
		</div>
	</div>
</div>
</div>