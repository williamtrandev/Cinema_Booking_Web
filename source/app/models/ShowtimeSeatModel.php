<?php
class ShowtimeSeatModel extends BaseModel
{
	public function update($id_suatchieu, $id_ghe, $trangthai)
	{
		$res = $this->db->prepare("update suatchieu_ghe set trangthai=? where id_suatchieu=? and id_ghe=?");
		$res->bind_param('iii', $trangthai, $id_suatchieu, $id_ghe);
		$res->execute();
		return $res->affected_rows;
	}
}
