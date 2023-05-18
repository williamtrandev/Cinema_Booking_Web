<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" href="<?php echo _WEB_ROOT; ?>/public/assets/server/img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/client/css/login.css" />
	<title>Đăng nhập</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
	<div class="login-container <?php if (isset($_SESSION['isRegister'])) echo "sign-up-mode"; ?>">
		<div class="forms-container">
			<div class="signin-signup">
				<form action="<?php echo _WEB_ROOT ?>/user/authenticate" class="sign-in-form" method="post">
					<h2 class="title">Đăng nhập</h2>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" placeholder="Số điện thoại" name="username" required maxlength="10" />
					</div>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" placeholder="Mật khẩu" name="password" required />
					</div>
					<?php if (isset($_SESSION['err'])) {
						echo "<div style='color: red;'>" . $_SESSION['err'] . "</div>";
						unset($_SESSION['err']);
					} ?>
					<input type="submit" value="Đăng nhập" class="btn solid" />
				</form>
				<form action="<?php echo _WEB_ROOT ?>/user/register" class="sign-up-form" method="post">
					<h2 class="title">Đăng ký</h2>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" placeholder="Họ và tên" name="name_register" required <?php if (isset($_SESSION['value_err']['name'])) echo "value='" . $_SESSION['value_err']['name'] . "'"; ?> />
					</div>
					<div class="input-field">
						<i class="fas fa-envelope"></i>
						<input type="email" placeholder="Email" name="email_register" required <?php if (isset($_SESSION['value_err']['email'])) echo "value='" . $_SESSION['value_err']['email'] . "'"; ?> />
					</div>
					<div class="input-field">
						<i class="fa-solid fa-phone"></i>
						<input type="tel" pattern="(\+84|0)\d{9,10}" placeholder="Số điện thoại" name="phone_register" maxlength="10" required <?php if (isset($_SESSION['value_err']['phone'])) echo "value='" . $_SESSION['value_err']['phone'] . "'"; ?> />
					</div>
					<div class="input-field">
						<i class="fa-solid fa-cake-candles"></i>
						<input type="text" placeholder="Ngày sinh (dd-mm-yyyy)" name="birthday_register" required pattern="\d{2}-\d{2}-\d{4}" <?php if (isset($_SESSION['value_err']['birthday'])) echo "value='" . $_SESSION['value_err']['birthday'] . "'"; ?> />
					</div>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" placeholder="Mật khẩu" name="pass_register" minlength="6" required <?php if (isset($_SESSION['value_err']['password'])) echo "value='" . $_SESSION['value_err']['password'] . "'"; ?> />
					</div>
					<div class="input-field">
						<i class="fa-sharp fa-solid fa-unlock"></i>
						<input type="password" placeholder="Nhập lại mật khẩu" minlength="6" name="confirm_register" required <?php if (isset($_SESSION['value_err']['confirm_password'])) echo "value='" . $_SESSION['value_err']['confirm_password'] . "'"; ?> />
					</div>
					<?php if (isset($_SESSION['err_register'])) {
						echo "<div style='color: red;'>" . $_SESSION['err_register'] . "</div>";
						unset($_SESSION['err_register']);
					} ?>
					<input type="submit" class="btn" value="Đăng ký" />
				</form>
			</div>
		</div>

		<div class="panels-container">
			<div class="panel left-panel">
				<div class="content">
					<h3>Bạn chưa có tài khoản ?</h3>
					<p>
						Hãy đăng ký tài khoản để trải nghiệm dịch vụ tại WillCinema bạn nhé!
					</p>
					<button class="btn transparent" id="sign-up-btn">
						Đăng ký
					</button>
				</div>
				<img src="<?php echo _WEB_ROOT ?>/public/assets/server/img/img_login.png" class="image" alt="" />
			</div>
			<div class="panel right-panel">
				<div class="content">
					<h3>Bạn đã có tài khoản?</h3>
					<p>
						Đăng nhập vào để mua vé nhé.
					</p>
					<button class="btn transparent" id="sign-in-btn">
						Đăng nhập
					</button>
				</div>
				<img src="<?php echo _WEB_ROOT ?>/public/assets/server/img/img_register.png" class="image" alt="" />
			</div>
		</div>
	</div>

	<script>
		$("#sign-up-btn").click(() => {
			$(".login-container").addClass("sign-up-mode");
		})
		$("#sign-in-btn").click(() => {
			$(".login-container").removeClass("sign-up-mode");
		})
	</script>
</body>

</html>