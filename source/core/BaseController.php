<?php
class BaseController {
	public function model($model) {
		if(file_exists(_DIR_ROOT . '/app/models/' . $model . '.php')) {

			require_once _DIR_ROOT . '/app/models/' . $model . '.php';
			if(class_exists($model)) {
				$model = new $model();
				return $model;
			}
		}
		return false;
	}
	public function render($view, $data=[]) {
		extract($data); // Doi key cua mang thanh bien;
		if(file_exists(_DIR_ROOT . '/app/views/' . $view . '.php')) {
			require_once _DIR_ROOT . '/app/views/' . $view . '.php';
		}
	}
}