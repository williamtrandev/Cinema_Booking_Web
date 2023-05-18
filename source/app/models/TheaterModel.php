<?php
class TheaterModel extends BaseModel
{
	protected $_table = 'rap';

	public function getAll()
	{
		$res = $this->db->query("select * from rap");
		$data = [];
		while ($row = $res->fetch_assoc()) {
			$data[] = $row;
		}
		return json_encode($data);
	}
	public function insert($name, $address) {
		$res = $this->db->prepare("insert into rap (name, address) values(?,?)");
		$res->bind_param("ss", $name, $address);
		$res->execute();
		return $res->affected_rows;
	}
}
