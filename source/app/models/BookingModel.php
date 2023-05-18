<?php
class BookingModel extends BaseModel
{
	protected $_table = 'phim';
	public function getDetail($id)
	{
		$data = $this->db->prepare("select p.*, np.name_nhanphim from phim p join nhanphim np on p.id_nhanphim=np.id_nhanphim where p.id_phim = ?");
		$data->bind_param("i", $id);
		$data->execute();
		$film = $data->get_result()->fetch_assoc();
		return json_encode($film);
	}
}
