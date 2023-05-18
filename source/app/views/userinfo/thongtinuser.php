<div class="title text">
	<h2 class="mb-0">Thông tin cá nhân</h2>
</div>
<div class="user-info-wrapper">
	<div class="user-profile-card">
		<div class="group-avatar">
			<img src="<?php echo _WEB_ROOT . "/public/assets/client/img/$data->avatar_path" ?>" alt="" />
			<h5 class=" user-name text"><?php echo $data->name; ?></h5>
		</div>
		<div class="sovemua">
			<p class="text">Vé đã mua</p>
			<p style="color: rgb(232, 165, 39)"><?php if ($suatchieu->soluong) echo $suatchieu->soluong;
												else echo 0 ?></p>
		</div>
		<div class="tichdiem">
			<p class="text">Tích điểm cá nhân</p>
			<p style="color: rgb(28, 145, 135)"><?php echo $data->point ?></p>
		</div>
	</div>

	<div class="detail-wrapper">
		<div>
			<div class="detail-info">
				<div class="info-box">
					<span class="text">Họ tên</span>
					<input type="text" name="" id="name-update" value="<?php echo $data->name ?>" readonly />
				</div>
				<div class="info-box">
					<span class="text">Số điện thoại</span>
					<input type="text" name="" id="phone-update" maxlength="10" value="<?php echo $data->phone ?>" readonly />
				</div>
				<div class="info-box">
					<span class="text">Email</span>
					<input type="email" name="" id="email-update" value="<?php echo $data->email ?>" readonly />
				</div>
				<div class="info-box">
					<span class="text">Ngày sinh</span>
					<input type="text" name="" id="birthday-update" pattern="(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}" value="<?php echo date("d-m-Y", strtotime($data->birthday)) ?>" readonly />
				</div>
			</div>
			<div class="msg-error-info mb-4"></div>
			<button class="my-btn me-5 edit-btn" style="background: var(--primary-color)">
				Chỉnh sửa thông tin
			</button>
			<button class="my-btn disabled update-btn" style="background: linear-gradient(to left bottom, #5ebaee, #dbe3ff, #ecb3fe); color: #0c244b">
				Cập nhật thông tin
			</button>
			<script>
				$(function() {

					$(".edit-btn").click(function() {
						$(".edit-btn").addClass("disabled");
						$(".update-btn").removeClass("disabled");
						$(".detail-info input").prop('readonly', false);
						$("#name-update").focus();
					})
					$(".detail-info input").click(function() {
						$(".msg-error-info").text("");
					})
				})
			</script>
		</div>
	</div>
</div>
<div class="title text">
	<h2 class="mb-0">Lịch sử mua vé phim</h2>
</div>
<div class="history-user">
	<table class="content-table">
		<thead>
			<tr>
				<th>STT</th>
				<th>Tên phim</th>
				<th>Số vé</th>
				<th>Thời gian</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 1;
			foreach ($thongtindat as $item) {
				$cln = $i % 2 == 0 ? " class='active-row'" : "";
				$date = date("d-m-Y", strtotime($item->ngaylap));
				echo "<tr" . $cln . ">
						<td>$i</td>
						<td>$item->name_phim</td>
						<td>$item->num_ticket</td>
						<td>$date</td>
					</tr>";
				$i++;
			}

			?>
		</tbody>
	</table>
</div>
<div class="modal fade" id="modalInfo">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Thông báo</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				Cập nhật thông tin thành công
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
			</div>

		</div>
	</div>
</div>