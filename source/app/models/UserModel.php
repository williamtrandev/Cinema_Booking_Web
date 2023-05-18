<?php
class UserModel extends BaseModel
{
	protected $_table = 'khachhang';
	
	public function getDetail($id)
	{
		$data = $this->db->prepare("select * from khachhang where id_khachhang = ?");
		$data->bind_param("i", $id);
		$data->execute();
		$info = $data->get_result()->fetch_assoc();
		return json_encode($info);
	}
	public function getDetailByPhone($phone) {
		$data = $this->db->prepare("select * from khachhang where phone = ?");
		$data->bind_param("s", $phone);
		$data->execute();
		$info = $data->get_result()->fetch_assoc();
		return json_encode($info);
	}
	public function login($username, $password) {
		$isAdmin = false;
		if($username == 'admin') {	// admin login
			$sql = "SELECT * FROM admin WHERE username=?";
			$isAdmin = true;
		} else {	// khách hàng login
			$sql = "SELECT * FROM khachhang WHERE phone=?";
		} 
		$result = $this->db->prepare($sql);
		$result->bind_param("s", $username);
		$result->execute();
		$user = $result->get_result();
		if ($user->num_rows == 1) {
			$row = $user->fetch_assoc();
			if (password_verify($password, $row['pass'])) {
				return ['authenticate'=>true, 'isAdmin'=>$isAdmin];
			}
		}
		return ['authenticate'=>false, 'isAdmin'=>$isAdmin];
	}
	public function checkExists($phone) {
		$data = $this->db->prepare("select * from khachhang where phone = ?");
		$data->bind_param("d", $phone);
		$data->execute();
		$user = $data->get_result();
		return $user->num_rows == 1;
	}
	public function register($name, $email, $phone, $birthday, $pass) {
		$res = $this->db->prepare("insert into khachhang (name, email, phone, birthday, pass) values(?,?,?,?,?)");
		$res->bind_param("sssss", $name, $email, $phone, $birthday, $pass);
		$res->execute();
		return $res->affected_rows == 1;
	}
	public function updatePoint($userid, $point) {
		$data = $this->db->prepare("update khachhang set point = point + ? where id_khachhang =?");
        $data->bind_param("ds", $point, $userid);
        $data->execute();
        return $data->affected_rows == 1;
	}
	public function updateInfo($name, $email, $birthday, $id_khachhang) {
		$data = $this->db->prepare("update khachhang set name=?, email=?, birthday=? where id_khachhang=?");
		$data->bind_param("sssi", $name, $email, $birthday, $id_khachhang);
		$data->execute();
		return $data->affected_rows == 1;
	}
	public function getNumberCustomer() {
		$res = $this->db->query("select count(*) as soluong from khachhang");
		$row = $res->fetch_assoc();
		return json_encode($row);
	}
	public function getAll($page) {
		$offset = ($page-1)*10;
		$res = $this->db->query("select * from khachhang order by point desc limit $offset, 10");
		$data = [];
		while($row = $res->fetch_assoc()) {
			$data[] = $row;
        }
		return json_encode($data);
	}
}
