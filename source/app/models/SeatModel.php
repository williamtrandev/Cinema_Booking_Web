<?php
class SeatModel extends BaseModel
{
	public function getAllByShowtime($id_suatchieu)
	{
		$res = $this->db->prepare("select * from ghe g join suatchieu_ghe scg on g.id_ghe = scg.id_ghe  where scg.id_suatchieu = ? order by hangghe, vitri");
		$res->bind_param('i', $id_suatchieu);
		$res->execute();
		$result = $res->get_result();
		$data = [];
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
		return json_encode($data);
	}
}
