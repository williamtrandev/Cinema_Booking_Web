<?php
class UserController extends BaseController
{
	public $model_user, $data = [];
	public function __construct()
	{
		$this->model_user = $this->model("UserModel");
	}
	public function index()
	{
		$this->data['title_page'] = 'Thông tin cá nhân';
    
		$this->data['link_css'] = "<link rel='stylesheet' href='" . _WEB_ROOT. "/public/assets/client/css/ttuser.css' />";
		// $this->data['content'] = $data;
		$user = json_decode($_SESSION['user']);
		$this->data['data_pass'] = json_decode($this->model_user->getDetail($user->id_khachhang));
		
		$this->data['suatchieu'] = json_decode($this->model("HistoryModel")->getNumberTicketById($user->id_khachhang));
		$this->data['info'] = json_decode($this->model("HistoryModel")->getAllTicketById($user->id_khachhang));;
		$this->data['content'] = 'userinfo/thongtinuser';
		$this->render("layout/client_layout", $this->data);
	}
	
	public function register() {
		if (isset($_POST['name_register']) && isset($_POST['email_register']) && isset($_POST['phone_register']) && isset($_POST['birthday_register']) && isset($_POST['pass_register']) && isset($_POST['confirm_register'])) {
			$name = $_POST['name_register'];
			$email = $_POST['email_register'];
			$phone = $_POST['phone_register'];
			$birthday = $_POST['birthday_register'];
			$password = $_POST['pass_register'];
			$confirm_password = $_POST['confirm_register'];
			// $user = $this->model_user->register($name, $email, $phone, $birthday, $password, $confirm_password);
			if (!$this->model_user->checkExists($phone)) {
				if($password != $confirm_password) {
					$_SESSION['err_register'] = "Mật khẩu xác nhận không khớp";
					$_SESSION['value_err'] = ['name' => $name, 'phone' => $phone, 'email' => $email, 'birthday' => $birthday, 'password' => $password, 'confirm_password' => $confirm_password];
					header("Location: " . _WEB_ROOT . "/user/login");
					exit();
				}
				// Mã hóa password và insert
				if ($this->model_user->register($name, $email, $phone, date('Y-m-d', strtotime($birthday)), password_hash($password, PASSWORD_BCRYPT))) {
					// Đăng ký thành công thì chuyển sang trang đăng nhập
					// Xóa các giá trị lưu trong session ở trang login
					if(isset($_SESSION['isRegister'])) unset($_SESSION['isRegister']);
					if (isset($_SESSION['value_err'])) unset($_SESSION['value_err']);
					header("Location: " . _WEB_ROOT . "/user/login");
					exit();
				}
			} else {
				// Lưu lại giá trị mà người dùng đã nhập để hiển thị khi form load lại
				$_SESSION['value_err'] = ['name' => $name, 'phone' => $phone, 'email' => $email, 'birthday' => $birthday, 'password' => $password, 'confirm_password' => $confirm_password];
				$_SESSION['isRegister'] = true;
				$_SESSION['err_register'] = "Số điện thoại đã được sử dụng";
				header("Location: " . _WEB_ROOT . "/user/login");
				exit();
			}
		}	
	}
	public function login() {
		$this->render("login/login");
	}
	public function authenticate() {
		if (isset($_POST['username']) && isset($_POST['password'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$user = $this->model_user->login($username, $password);
			if ($user['authenticate']) {
				if ($user['isAdmin']) {
					$_SESSION['user'] = $this->model("AdminModel")->getDetail($username);
					header("Location: " . _WEB_ROOT . "/admin");
					exit();
				} else {
					$_SESSION['user'] = $this->model_user->getDetailByPhone($username);
					if (isset($_SESSION['stack'])) {
						header("Location: " . $_SESSION['stack']);
						unset($_SESSION['stack']);
						exit();
					} else {
						header("Location: " . _WEB_ROOT . "/home");
						exit();
					}
				}
			} else {

				$_SESSION['err'] = "Sai số điện thoại hoặc mật khẩu";
				header("Location: " . _WEB_ROOT . "/user/login");
				exit();
			}
		}	
	}
	public function update($name, $email, $birthday) {
		$id_khachhang = json_decode($_SESSION['user'])->id_khachhang;
		echo $this->model_user->updateInfo($name, $email, $birthday, $id_khachhang);
	}
	public function logout() {
		// Xóa session
		session_destroy();
		// Chuyển đến trang home
		header("Location: ". _WEB_ROOT ."/home");
		exit();
	}
}
