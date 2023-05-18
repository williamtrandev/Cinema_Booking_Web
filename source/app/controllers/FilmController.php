<?php
class FilmController extends BaseController
{
	public $model_film, $data = [];
	public function __construct()
	{
		$this->model_film = $this->model("FilmModel");
	}
	public function index()
	{
		$this->data['title_page'] = 'Phim đang chiếu';
		$this->data['data_pass'] = json_decode($this->model_film->getShowingFilmList());
		$this->data['content'] = 'film/showing';
		$this->render("layout/client_layout", $this->data);
	}
	public function coming()
	{
		$this->data['title_page'] = 'Phim sắp chiếu';
		$this->data['data_pass'] = json_decode($this->model_film->getComingFilmList());
		$this->data['content'] = 'film/coming';
		$this->render("layout/client_layout", $this->data);
	}
	public function detail($id)
	{
		// Lưu lại trạng thái hiện tại để khi người dùng chưa đăng nhập
		// -> bắt người dùng đăng nhập sau đó chuyển lại trang này
		$_SESSION['stack'] = _WEB_ROOT . "/film/detail/$id";
		$_SESSION['id_phim_choosing'] = $id;	// Session lưu id phim đã chọn
		$this->data['title_page'] = 'Thông tin phim';
		$this->data['link_css'] = "<link rel='stylesheet' href='" . _WEB_ROOT . "/public/assets/client/css/infofilm.css' />";
		$this->data['content'] = 'film/detail';
		$this->data['data_pass'] = json_decode($this->model_film->getDetail($id));
		$resdata = json_decode($this->model("ShowtimeModel")->getAllSuatChieu($id));
		$result = array();
		foreach ($resdata as $suatchieu) {
			$rap = $suatchieu->name;
			$date = $suatchieu->date_show;
			$loaive = $suatchieu->name_loaive;
			$time = $suatchieu->time_show;
			$show_room = $suatchieu->id_phongchieu;
			$id_suatchieu = $suatchieu->id_suatchieu;
			if (!isset($result[$rap])) {
				$result[$rap] = array();
			}
			if (!isset($result[$rap][$date])) {
				$result[$rap][$date] = array();
			}
			if (!isset($result[$rap][$date][$loaive])) {
				$result[$rap][$date][$loaive] = array();
			}
			$result[$rap][$date][$loaive][] = [$time, $show_room, $id_suatchieu];
		}

		$this->data["suatchieu"] = $result;
		$this->render("layout/client_layout", $this->data);
	}
	public function getAllFilm()
	{
		$data = json_decode($this->model_film->getAllFilm());
		$this->renderCard($data);
	}
	private function renderCard($data)
	{
		$cards_film = "";
		foreach ($data as $obj) {
			$name = $obj->name_phim;
			$director = $obj->director;
			$tag = $obj->name_nhanphim;
			$tagClass = strtolower($tag);
			$href = _WEB_ROOT . '/film/detail/' . $obj->id_phim;
			$poster = _WEB_ROOT . "/public/assets/client/img/" . $obj->image_path;
			$span_3d = ($obj->phim_3d == 1) ? "<span
									class='film-3d d-flex align-items-center justify-content-center'
									>3D</span
								>" : "";
			$cards_film .=
				"<div class='w-100 d-flex justify-content-center'>
					<a class='card' href=$href>
						<div class='poster'>
							<img src='$poster' alt='poster' />
						</div>
						<div class='detail'>
							<h2 class='name-film'>
								$name
							</h2>
							<h3 class='director'>Đạo diễn $director</h3>

							<div
								class='tags d-flex justify-content-center p-2'
							>
								<span class='$tagClass'>$tag</span>
								<span
									class='film-2d d-flex align-items-center justify-content-center'
									>2D</span
								>
								$span_3d
							</div>
						</div>
					</a>
				</div >";
		}
		echo $cards_film;
	}
	public function getAllFilm3D()
	{
		$data = json_decode($this->model_film->getAllFilm3D());
		$this->renderCard($data);
	}
	public function getAllFilmComing()
	{
		$data = json_decode($this->model_film->getComingFilmList());
		$this->renderCard($data);
	}
	public function getAllFilm3DComing()
	{
		$data = json_decode($this->model_film->getAllFilm3DComing());
		$this->renderCard($data);
	}
	public function search($name)
	{
		$data = json_decode($this->model_film->getAllFilmByName($name));
		$this->renderCard($data);
	}
	public function getDuration($id_phim)
	{
		echo $this->model_film->getDuration($id_phim);
	}
	public function updateFilm()
	{
		$id_phim = $_POST['id_phim'];
		$name_phim = $_POST['name_phim'];
		$phim_3d = $_POST['phim_3d'];
		$id_nhanphim = $_POST['id_nhanphim'];
		$is_coming = $_POST['is_coming'];
		$duration = $_POST['duration'];
		$director = $_POST['director'];
		$actors = $_POST['actors'];
		$release_date = $_POST['release_date'];
		$description = $_POST['description'];
		$trailer_path = $_POST['trailer_path'];
		$image_path = $_FILES['image_path']['name'];
		if($image_path != '') {
			$target_dir = 'public/assets/client/img/';
			$target_file = $target_dir . basename($image_path);
			move_uploaded_file($_FILES['image_path']['tmp_name'], $target_file);
		}
		echo $this->model_film->updateFilm($id_phim, $name_phim, $is_coming, $phim_3d, $id_nhanphim, $duration, $director, $actors, $release_date, $description, $image_path, $trailer_path);
	}
	public function insert() {
		$name_phim = $_POST['name_phim-add'];
		$phim_3d = $_POST['phim_3d-add'];
		$id_nhanphim = $_POST['id_nhanphim-add'];
		$is_coming = $_POST['is_coming-add'];
		$duration = $_POST['duration-add'];
		$director = $_POST['director-add'];
		$actors = $_POST['actors-add'];
		$release_date = $_POST['release_date-add'];
		$description = $_POST['description-add'];
		$trailer_path = $_POST['trailer_path-add'];
		$target_dir = 'public/assets/client/img/';
		$image_path = $_FILES['image_path-add']['name'];
		$target_file = $target_dir . basename($image_path);
		move_uploaded_file($_FILES['image_path-add']['tmp_name'], $target_file);
		echo $this->model_film->insert($name_phim, $director, $actors, $id_nhanphim, $release_date, $duration, $description, $is_coming, $image_path, $trailer_path, $phim_3d);
	}
	public function delete($id_phim) {
		echo $this->model_film->delete($id_phim);
	}
}
