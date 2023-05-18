<?php
class FoodController extends BaseController
{
	public $model_food, $data = [];
	public function __construct()
	{
		$this->model_food = $this->model("FoodModel");
	}
	public function insert()
	{
		$name = $_POST['name-add'];
		$detail = $_POST['detail-add'];
		$price = $_POST['price-add'];
		$target_dir = 'public/assets/client/img/';
		$image_path = $_FILES['image_path-add']['name'];
		$target_file = $target_dir . basename($image_path);
		move_uploaded_file($_FILES['image_path-add']['tmp_name'], $target_file);
		echo $this->model_food->insert($name, $detail, $price, $image_path);
	}
	public function update() {
		$id_combo = $_POST['id_combo'];
		$name = $_POST['name'];
		$detail = $_POST['detail'];
		$price = $_POST['price'];
		$target_dir = 'public/assets/client/img/';
		$image_path = $_FILES['image_path']['name'];
		if ($image_path != '') {
			$target_dir = 'public/assets/client/img/';
			$target_file = $target_dir . basename($image_path);
			move_uploaded_file($_FILES['image_path']['tmp_name'], $target_file);
		}
		echo $this->model_food->update($name, $detail, $price, $image_path, $id_combo);
	}
	public function delete($id_combo) {
		echo $this->model_food->delete($id_combo);
	}
}
