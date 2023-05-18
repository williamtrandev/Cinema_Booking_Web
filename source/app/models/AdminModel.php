<?php
class AdminModel extends BaseModel
{
	protected $_table = 'admin';

	public function getDetail($username)
	{
		$data = $this->db->prepare("select * from admin where username = ?");
		$data->bind_param("s", $username);
		$data->execute();
		$info = $data->get_result()->fetch_assoc();
		return json_encode($info);
	}
}
