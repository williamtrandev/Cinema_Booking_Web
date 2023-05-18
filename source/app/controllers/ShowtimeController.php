<?php
class ShowtimeController extends BaseController
{
	public $model_showtime, $data = [];
	public function __construct()
	{
		$this->model_showtime = $this->model("ShowtimeModel");
	}
	public function checkTrungSuatChieu($suatchieu_check, $phongchieu_check, $ngaychieu_check, $duration_check) {
		echo $this->model_showtime->checkTrungSuatChieu($suatchieu_check, $phongchieu_check, $ngaychieu_check, $duration_check);
	}
	public function insert($id_phim, $id_rap, $id_loaive, $id_phongchieu, $dateshow, $timeshow) {
		echo $this->model_showtime->insert($id_phim, $id_rap, $id_loaive, $id_phongchieu, $dateshow, $timeshow);
	}
	public function delete($id_suatchieu) {
		echo $this->model_showtime->delete($id_suatchieu);
	}
}
