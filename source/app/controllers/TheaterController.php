<?php
class TheaterController extends BaseController
{
	public $model_theater, $data = [];
	public function __construct()
	{
		$this->model_theater = $this->model("TheaterModel");
	}
	public function index() {
		$this->data['title_page'] = 'Hệ thống rạp';
		$this->data['content'] = 'theater/theater';
		$this->data['link_css'] = "<link rel='stylesheet' href='" . _WEB_ROOT . "/public/assets/client/css/theater.css' />";
		$this->data['data_pass'] = json_decode($this->model_theater->getAll());
		$this->render("layout/client_layout", $this->data);
	}
	public function getAll() {
		echo $this->model_theater->getAll();
	}
	public function insert($name, $address) {
		echo $this->model_theater->insert($name, $address);
	}
}
