<?php
class AdminController extends BaseController
{
	public $model_admin, $data = [];
	public function __construct()
	{
		$this->model_admin = $this->model("AdminModel");
	}
	public function index()
	{
		$this->data['title_page'] = 'Thống kê doanh thu';
		$this->data['content'] = 'admin/revenue';
		$this->data['data_pass'] = '';
		$this->render("layout/admin_layout", $this->data);
	}
	public function filmList() {
		$this->data['title_page'] = 'Danh sách phim';
		$this->data['content'] = 'admin/filmlist';
		$this->data['info'] = json_decode($this->model("FilmModel")->getComingFilmList());
		$this->data['data_pass'] = json_decode($this->model("FilmModel")->getShowingFilmList());
		$this->render("layout/admin_layout", $this->data);

	}
	public function theaterList() {
		$this->data['title_page'] = 'Danh sách rạp';
		$this->data['content'] = 'admin/theaterlist';
		$this->data['data_pass'] = json_decode($this->model("TheaterModel")->getAll());
		$this->render("layout/admin_layout", $this->data);
	}
	public function customerList($page=1) {
		$this->data['title_page'] = 'Danh sách khách hàng';
		$this->data['content'] = 'admin/customerlist';
		$this->data['info'] = json_decode($this->model("UserModel")->getNumberCustomer())->soluong;
		$this->data['data_pass'] = json_decode($this->model("UserModel")->getAll($page));
		$this->render("layout/admin_layout", $this->data);
	}
	public function historyList($page=1) {
		$this->data['title_page'] = 'Lịch sử đặt vé';
        $this->data['content'] = 'admin/historylist';
		$this->data['info'] = json_decode($this->model("HistoryModel")->getNumberHistory())->soluong;
        $this->data['data_pass'] = json_decode($this->model("HistoryModel")->getAllHistory($page));
        $this->render("layout/admin_layout", $this->data);
	}
	public function foodList() {
		$this->data['title_page'] = 'Danh sách món ăn';
		$this->data['content'] = 'admin/foodlist';
		$this->data['data_pass'] = json_decode($this->model("FoodModel")->getAll());
		$this->render("layout/admin_layout", $this->data);
	}
	public function ticketList() {
		$this->data['title_page'] = 'Thay đổi giá vé';
		$this->data['content'] = 'admin/ticketlist';
		$this->data['data_pass'] = json_decode($this->model("TicketModel")->getAll());
		$this->render("layout/admin_layout", $this->data);
	}
	public function getAllFilmHistory() {
		echo json_decode($this->model("HistoryModel")->getAll())->soluong;
	}
	public function getInfoRevenue($dateStart, $dateEnd, $page=1) {
		echo $this->model("HistoryModel")->getStatistic($dateStart, $dateEnd, $page);
	}
	public function getTotalRevenue($dateStart, $dateEnd) {
		echo json_decode($this->model("HistoryModel")->getTotalRevenue($dateStart, $dateEnd))->tongtien;
	}
	public function getAllSuatChieuByRap($id_rap) {
		echo $this->model("ShowtimeModel")->getAllSuatChieuByRap($id_rap);
	}
	public function getAllPhongChieu() {
		echo $this->model("ShowroomModel")->getAll();
	}
	public function getAllFilmShowing() {
		echo $this->model("FilmModel")->getShowingFilmList();
	}
}
