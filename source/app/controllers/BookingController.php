<?php
class BookingController extends BaseController
{
	public $model_booking, $data = [];
	public function __construct()
	{
		$this->model_booking = $this->model("BookingModel");
	}
	public function index($time, $type, $date, $idsc, $room)
	{
		if (!isset($_SESSION['user'])) {
			header("Location: " . _WEB_ROOT . "/user/login");
			exit();
			// return;
		}
		// Lưu thông tin của suất chiếu mà người dùng chọn vào session
		$_SESSION['time-booking'] = $time;
		$_SESSION['type-booking'] = $type;
		$_SESSION['date-booking'] = $date;
		$_SESSION['id-booking'] = $idsc;
		// echo $_SESSION['id-booking'];
		$ghe = json_decode($this->model("SeatModel")->getAllByShowtime($idsc));
		$this->data['data_ghe'] = $ghe;
		$this->data['title_page'] = 'Chọn ghế';
		$this->data['link_css'] = "<link rel='stylesheet' href='" . _WEB_ROOT . "/public/assets/client/css/chonbapnuoc.css' />";
		$this->data['link_script'] = "<script src='" . _WEB_ROOT . "/public/assets/client/js/chonghe.js'></script>";
		$this->data['content'] = 'booking/chonghe';
		$id_phim_choosing = $_SESSION['id_phim_choosing'];
		$data = json_decode($this->model("FilmModel")->getDetail($id_phim_choosing));
		$this->data['data_pass'] = $data;
		$this->render("layout/client_layout", $this->data);
	}
	public function chooseFoods()
	{
		$this->data['title_page'] = 'Chọn bắp nước';
		$this->data['link_css'] = "<link rel='stylesheet' href='" . _WEB_ROOT . "/public/assets/client/css/chonbapnuoc.css' />";
		$this->data['link_script'] = "<script src='" . _WEB_ROOT . "/public/assets/client/js/chonbapnuoc.js'></script>";
		$info = $this->model("ShowtimeModel")->detail($_SESSION['id-booking']);
		$this->data['info'] = json_decode($info);
		$this->data['content'] = 'booking/chonbapnuoc';
		$this->data['data_pass'] = json_decode($this->model("FoodModel")->getAll());
		$this->render("layout/client_layout", $this->data);
	}
	public function checkout()
	{
		$data = json_decode(file_get_contents('php://input'), true);
		// echo $data;
		$id_khachhang = json_decode($_SESSION['user'])->id_khachhang;
		$id_suatchieu = $_SESSION['id-booking'];
		$num_ticket = $data['lichsu']['soluongve'];
		$seat = $data['lichsu']['ghedat'];
		$total_price = $data['lichsu']['tongtien'];
		// Insert vào lịch sử
		$this->model("HistoryModel")->insert($id_khachhang, $id_suatchieu, $num_ticket, $seat, $total_price);
		$seats = json_decode($data['data_datcho']);
		// Đánh dấu các ghế đã được đặt
		foreach ($seats as $item) {
			$this->model("ShowtimeSeatModel")->update($item->id_suatchieu, $item->id_ghe, 1);
		}
		// Update điểm cho khách hàng
		$this->model("UserModel")->updatePoint($id_khachhang, 10 * $num_ticket);
		//Đặt vé xong chuyển người dùng đến trang thông tin cá nhân để xem vé

		// $this->mail->addAddress();
		require _DIR_ROOT . "/app/helpers/Mailer.php";
		try {
			$to = json_decode($_SESSION['user'])->email;
			$title = "Thông báo đặt vé thành công";
			$subject = mb_encode_mimeheader($title, "UTF-8", "B");
			$body = "WillCinema xin cảm ơn bạn đã đặt vé xem phim tại rạp chúng tôi <br> Số vé đã đặt: $num_ticket <br> Tổng tiền: $total_price";
			Mailer::getInstance()->sendMail($to, $subject, $body);
		} catch (Exception $e) {
		}
		echo _WEB_ROOT . "/user";
	}
}
