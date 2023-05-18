<?php
class TicketModel extends BaseModel
{
	public function getAll()
	{
		$res = $this->db->query("select * from loaive");
		$data = [];
		while ($row = $res->fetch_assoc()) {
			$data[] = $row;
		}
		return json_encode($data);
	}
	public function update($id_loaive, $price) {
		$res = $this->db->prepare("update loaive set price = ? where id_loaive = ?");
		$res->bind_param('ii', $price, $id_loaive);
		$res->execute();
		return $res->affected_rows;
	}
}
