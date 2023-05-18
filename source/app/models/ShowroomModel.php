<?php
class ShowroomModel extends BaseModel
{
	public function getAll($id_rap)
	{
		$res = $this->db->prepare("select * from phongchieu where id_rap = ?");
		$res->bind_param('i', $id_rap);
		$res->execute();
		$result = $res->get_result();
		$data = [];
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
		return json_encode($data);
	}
	public function insert($name, $row, $id) {
		$res = $this->db->prepare("insert into phongchieu(name_phongchieu,sohang,id_rap) values(?,?,?)");
        $res->bind_param('sii', $name, $row, $id);
        $res->execute();
        return $res->affected_rows;
	}
}
