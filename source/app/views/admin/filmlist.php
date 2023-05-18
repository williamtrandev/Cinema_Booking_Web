	<!-- ===================== THỐNG KÊ THEO PHIM ===================== -->
	<div class="staticFilm">
		<div class="head mb-5">
			<h1>Doanh sách phim</h1>
			<button class="button" data-bs-toggle="modal" data-bs-target="#modal-add-film">
				Thêm mới
			</button>
		</div>

		<h1>Phim đang chiếu</h1>
		<div class="movies my-5">
			<?php
			$moviesShowing = array();
			$index = 0;
			foreach ($data as $item) {
				$movie = array(
					'id_phim' => $item->id_phim,
					'name_phim' => $item->name_phim,
					'phim_3d' => $item->phim_3d,
					'id_nhanphim' => $item->id_nhanphim,
					'is_coming' => $item->is_coming,
					'duration' => $item->duration,
					'director' => $item->director,
					'actors' => $item->actors,
					'release_date' => $item->release_date,
					'description' => $item->description,
					'trailer_path' => $item->trailer_path,
				);
				$moviesShowing[] = $movie;
				$poster = _WEB_ROOT . "/public/assets/client/img/" . $item->image_path;
				echo "<div class='movie' onclick='openEdit($index)'>
						<div class='img' style='height: 100%;'>
							<img src='$poster' style='height: 100%; object-fit: cover'/>
						</div>
						<div class='info'>
							<h3>$item->name_phim</h3>
							<button class='button' onclick='openEdit($index)'>Sửa</button>
						</div>
					</div>";
				$index++;
			}

			?>
			<script>
				function openEdit(movieIndex) {
					let movie = <?php echo json_encode($moviesShowing); ?>[movieIndex];
					// Sử dụng dữ liệu phim để load lên form
					$(".name-edit").val(movie.name_phim);
					$(".phim_3d-edit").val(movie.phim_3d);
					$(".id_nhanphim-edit").val(movie.id_nhanphim);
					$(".coming-edit").val(movie.is_coming);
					$(".duration-edit").val(movie.duration);
					$(".director-edit").val(movie.director);
					$(".actors-edit").val(movie.actors);
					$(".release_date-edit").val(movie.release_date);
					$(".description-edit").val(movie.description);
					$(".trailer_path-edit").val(movie.trailer_path);
					$("#edit .modal-body").data("id_phim", movie.id_phim);

					$("#edit").modal("show");
				}
			</script>
		</div>

		<h1>Phim sắp chiếu</h1>
		<div class="movies my-5">
			<?php
			$movies = array();
			$index = 0;
			foreach ($info as $item) {
				$movie = array(
					'id_phim' => $item->id_phim,
					'name_phim' => $item->name_phim,
					'phim_3d' => $item->phim_3d,
					'id_nhanphim' => $item->id_nhanphim,
					'is_coming' => $item->is_coming,
					'duration' => $item->duration,
					'director' => $item->director,
					'actors' => $item->actors,
					'release_date' => $item->release_date,
					'description' => $item->description,
					'trailer_path' => $item->trailer_path,
				);
				$movies[] = $movie;
				$poster = _WEB_ROOT . "/public/assets/client/img/" . $item->image_path;

				echo "<div class='movie' onclick='openEditComing($index)'>
						<div class='img' style='height: 100%;'>
							<img src='$poster' style='height: 100%; object-fit: cover'/>
						</div>
						<div class='info'>
							<h3>$item->name_phim</h3>
							<button class='button' onclick='openEditComing($index)' style='text-transform: none'>Sửa</button>
						</div>
					</div>";
				$index++;
			}
			?>
			<script>
				function openEditComing(movieIndex) {
					let movie = <?php echo json_encode($movies); ?>[movieIndex];
					// Sử dụng dữ liệu phim để load lên form
					console.log(movie.phim_3d);
					$(".name-edit").val(movie.name_phim);
					$(".phim_3d-edit").val(movie.phim_3d);
					$(".id_nhanphim-edit").val(movie.id_nhanphim);
					$(".coming-edit").val(movie.is_coming);
					$(".duration-edit").val(movie.duration);
					$(".director-edit").val(movie.director);
					$(".actors-edit").val(movie.actors);
					$(".release_date-edit").val(movie.release_date);
					$(".description-edit").val(movie.description);
					$(".trailer_path-edit").val(movie.trailer_path);
					$("#edit .modal-body").data("id_phim", movie.id_phim);
					$("#edit").modal("show");

				}
			</script>
		</div>
	</div>

	<button data-bs-toggle="modal" data-bs-target="#edit" id="button-edit"></button>
	</main>
	<div class="modal fade" id="modal-add-film" tabindex="-1" aria-labelledby="modal-add-film" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="">
						Thêm phim mới
					</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="post" enctype="multipart/form-data" class="upload-form-add">
						<div class="mb-3">
							<label for="recipient-name" class="col-form-label">Tên phim:</label>
							<input type="text" class="form-control name-add" id="recipient-name" name="name_phim-add" />
						</div>
						<div class="mb-3">
							<label for="message-text" class="col-form-label">Loại vé (Chọn 3D nếu phim có 3D):</label>
							<select class="form-control phim_3d-add" id="message-text" name="phim_3d-add">
								<option value="" selected disabled>Chọn</option>
								<option value="0">2D</option>
								<option value="1">3D</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="message-text" class="col-form-label">Phim:</label>
							<select class="form-control is_coming-add" id="message-text" name="is_coming-add">
								<option value="" selected disabled>Chọn</option>
								<option value="0">Đang chiếu</option>
								<option value="1">Sắp chiếu</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="message-text" class="col-form-label">Nhãn phim:</label>
							<select class="form-control id_nhanphim-add" id="message-text" name="id_nhanphim-add">
								<option value="" selected disabled>Chọn</option>
								<option value="1">P</option>
								<option value="2">C13</option>
								<option value="3">C16</option>
								<option value="4">C18</option>
							</select>
						</div>

						<div class="mb-3">
							<label for="message-text" class="col-form-label">Hình ảnh:</label>
							<input type="file" accept="image/*" class="form-control" id="message-text" name="image_path-add" />
						</div>

						<div class="mb-3">
							<label for="message-text" class="col-form-label ">Thời gian phim:</label>
							<input type="text" class="form-control duration-add" id="message-text" name="duration-add" />
						</div>

						<div class="mb-3">
							<label for="message-text" class="col-form-label ">Đạo diễn:</label>
							<input type="text" class="form-control director-add" id="message-text" name="director-add" />
						</div>

						<div class="mb-3">
							<label for="message-text" class="col-form-label ">Diễn viên:</label>
							<input type="text" class="form-control actors-add" id="message-text" name="actors-add" />
						</div>

						<div class="mb-3">
							<label for="message-text" class="col-form-label ">Thời gian khởi chiếu:</label>
							<input type="date" class="form-control release_date-add" id="message-text" name="release_date-add" />
						</div>

						<div class="mb-3">
							<label for="message-text" class="col-form-label ">Nội dung phim:</label>
							<textarea type="text" class="form-control description-add" id="message-text" rows="5" name="description-add"></textarea>
						</div>

						<div class="mb-3">
							<label for="message-text" class="col-form-label">Trailer:</label>
							<input type="text" class="form-control trailer_path-add" id="message-text" name="trailer_path-add" />
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
						Đóng
					</button>
					<button type="button" class="btn btn-primary save-add-film" onclick="insertFilm()">Lưu</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhật</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<script>
					function updateFilm() {
						const form = document.querySelector('.upload-form');
						const formData = new FormData(form);
						formData.append("id_phim", $("#edit .modal-body").data("id_phim"));
						fetch('<?php echo _WEB_ROOT ?>/film/updateFilm', {
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

					function removeFilm() {
						let id_phim = $("#edit .modal-body").data("id_phim");
						fetch(`<?php echo _WEB_ROOT ?>/film/delete/${id_phim}`)
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
				</script>
				<div class="modal-body">
					<form method="post" enctype="multipart/form-data" class="upload-form">
						<div class="mb-3">
							<label for="recipient-name" class="col-form-label">Tên phim:</label>
							<input type="text" class="form-control name-edit" id="recipient-name" name="name_phim" />
						</div>
						<div class="mb-3">
							<label for="message-text" class="col-form-label">Loại vé (Chọn 3D nếu phim có 3D):</label>
							<select class="form-control phim_3d-edit" id="message-text" name="phim_3d">
								<option value="" selected disabled>Chọn</option>
								<option value="0">2D</option>
								<option value="1">3D</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="message-text" class="col-form-label">Phim:</label>
							<select class="form-control coming-edit" id="message-text" name="is_coming">
								<option value="" selected disabled>Chọn</option>
								<option value="0">Đang chiếu</option>
								<option value="1">Sắp chiếu</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="message-text" class="col-form-label">Nhãn phim:</label>
							<select class="form-control id_nhanphim-edit" id="message-text" name="id_nhanphim">
								<option value="" selected disabled>Chọn</option>
								<option value="1">P</option>
								<option value="2">C13</option>
								<option value="3">C16</option>
								<option value="4">C18</option>
							</select>
						</div>

						<div class="mb-3">
							<label for="message-text" class="col-form-label">Hình ảnh:</label>
							<input type="file" accept="image/*" class="form-control" id="message-text" name="image_path" />
						</div>

						<div class="mb-3">
							<label for="message-text" class="col-form-label ">Thời gian phim:</label>
							<input type="text" class="form-control duration-edit" id="message-text" name="duration" />
						</div>

						<div class="mb-3">
							<label for="message-text" class="col-form-label ">Đạo diễn:</label>
							<input type="text" class="form-control director-edit" id="message-text" name="director" />
						</div>

						<div class="mb-3">
							<label for="message-text" class="col-form-label ">Diễn viên:</label>
							<input type="text" class="form-control actors-edit" id="message-text" name="actors" />
						</div>

						<div class="mb-3">
							<label for="message-text" class="col-form-label ">Thời gian khởi chiếu:</label>
							<input type="date" class="form-control release_date-edit" id="message-text" name="release_date" />
						</div>

						<div class="mb-3">
							<label for="message-text" class="col-form-label ">Nội dung phim:</label>
							<textarea type="text" class="form-control description-edit" id="message-text" rows="5" name="description"></textarea>
						</div>

						<div class="mb-3">
							<label for="message-text" class="col-form-label">Trailer:</label>
							<input type="text" class="form-control trailer_path-edit" id="message-text" name="trailer_path" />
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
						Đóng
					</button>
					<button type="button" class="btn btn-primary save-edit" onclick="updateFilm()">Lưu</button>
					<button type="button" class="btn btn-danger" onclick="removeFilm()">Xóa</button>
				</div>
				<script>
					function insertFilm() {
						const form = document.querySelector('.upload-form-add');
						const formData = new FormData(form);
						fetch('<?php echo _WEB_ROOT ?>/film/insert', {
								method: 'POST',
								body: formData,
							})
							.then(res => res.text())
							.then(data => {
								console.log(data);
								if (data == 1) {
									alert('Thêm phim thành công');
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
			</div>
		</div>
	</div>