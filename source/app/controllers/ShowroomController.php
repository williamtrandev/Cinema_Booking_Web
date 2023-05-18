<?php
class ShowroomController extends BaseController
{
	public $model_showroom, $data = [];
	public function __construct()
	{
		$this->model_showroom = $this->model("ShowroomModel");
	}
	public function index($id_rap)
	{
		echo $this->model_showroom->getAll($id_rap);
	}
	public function insert($name, $row, $id) {
		echo $this->model_showroom->insert($name, $row, $id);
	}
}
