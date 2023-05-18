<?php
class BannerModel extends BaseModel
{
	public function getAll() {
		$res = $this->db->query("select * from banner");
		$data = [];
		while($row = $res->fetch_assoc()) {
			$data[] = $row;
		} 
		return json_encode($data);
	}
}
