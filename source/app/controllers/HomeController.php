<?php
class HomeController extends BaseController
{
	public $model_home, $data = [];
	public function __construct()
	{
		$this->model_home = $this->model("HomeModel");
	}
	public function index()
	{
		$this->data['title_page'] = 'Trang chủ';
		// $this->data['content'] = $data;
		$this->data['info_banner'] = json_decode($this->model("BannerModel")->getAll());
		$this->data['banner'] = 'blocks/banner';
		$this->data['content'] = ''; // content giữ đường dẫn đến file view


		$film_model = $this->model("FilmModel");
		$data = $film_model->getShowingFilmList("limit 8");
		$data = json_decode($data);
		// var_dump($data);
		//$loaive = $data->name;

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
		$this->data['cards'] = $cards_film;
		$this->data['showing'] = 'home/showing_film';
		$data = $film_model->getComingFilmList("order by id_phim limit 6");
		$data = json_decode($data);
		$imgs = "";
		$detail1 = "";
		$detail2 = "";
		$index = 0;
		foreach ($data as $obj) {
			$id_phim = $obj->id_phim;
			$name = $obj->name_phim;
			$director = $obj->director;
			$tag = $obj->name_nhanphim;
			$href = _WEB_ROOT . '/film/detail/' . $obj->id_phim;
			// Mô tả 200 từ được cắt đảm bảo chỉ cắt nguyên chữ không cắt ngang chữ.
			$desc = substr($obj->description, 0, strrpos(substr($obj->description, 0, 200), ' ')) . '...';
			
			$poster = _WEB_ROOT . "/public/assets/client/img/" . $obj->image_path;
			$imgs .= "<div class='item' style='--i: $index;'>
							<img src='$poster'>
						</div>";
			if ($index == 0)
				$detail1 .= "<div class='item active'>
                            <h3>$name</h3>
                            <div class='des'>
                                $desc
                            </div>
                            <a href=$href>Xem thêm</a>
                        </div>";
			else
				$detail2 = "<div class='item'>
                            <h3>$name</h3>
                            <div class='des'>
                                $desc
                            </div>
                            <a href=$href>Xem thêm</a>
                        </div>" . $detail2;
			$index++;
		}
		$this->data['link_css'] = "<link rel='stylesheet' href='" . _WEB_ROOT. "/public/assets/client/css/slider.css' />";
		$this->data['imgs'] = $imgs;
		$this->data['data_pass'] = '';
		// Do phim sắp chiếu hiển thị dưới dạng vòng tròn nên có sự sắp xếp lại
		$this->data['detail'] = $detail1.$detail2;
		$this->data['coming'] = 'home/coming_film';
		// $this->data['userinfo'] = 'userinfo/thongtinuser';
		$this->render("layout/client_layout", $this->data);
	}
	public function detail($id)
	{
		$film_model = $this->model("FilmModel");
		$data = $film_model->getDetail($id);
		$data = json_decode($data, true);
		$this->render("film/detail", $data);
	}
}
