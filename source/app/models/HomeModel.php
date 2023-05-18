<?php
class HomeModel extends BaseModel{
	protected $_table = 'test';
	
	public function getDetail($id) {
		$data = [
			'Item 1',
			'Item 2',
			'Item 3'
		];
		return $data[$id];
	}
}