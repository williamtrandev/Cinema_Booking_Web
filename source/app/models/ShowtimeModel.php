<?php
class ShowtimeModel extends BaseModel
{
	protected $_table = 'suatchieu';
	public function detail($id) {
		$res = $this->db->prepare("select * from suatchieu sc join rap r on sc.id_rap = r.id_rap join loaive lv on sc.id_loaive=lv.id_loaive join phongchieu pc on sc.id_phongchieu = pc.id_phongchieu join phim p on sc.id_phim = p.id_phim join nhanphim np on p.id_nhanphim=np.id_nhanphim where id_suatchieu = ?");
		$res->bind_param("i", $id);
		$res->execute();
		$info = $res->get_result()->fetch_assoc();
		return json_encode($info);
	}
	public function getAllSuatChieu($id)
	{
		$res = $this->db->prepare("select * from suatchieu sc join rap r on sc.id_rap = r.id_rap join loaive lv on sc.id_loaive=lv.id_loaive join phongchieu pc on sc.id_phongchieu = pc.id_phongchieu where id_phim = ? and sc.date_show BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 2 DAY) and sc.deleted = 0");
		$res->bind_param("i", $id);
		$res->execute();
		$data = [];
		$info = $res->get_result();
		while($row = $info->fetch_assoc()) {
			$data[] = $row;
		}
		return json_encode($data);
	}
	public function getAllSuatChieuByRap($id_rap) {
		$res = $this->db->prepare("select * from suatchieu sc join rap r on sc.id_rap = r.id_rap join loaive lv on sc.id_loaive=lv.id_loaive join phongchieu pc on sc.id_phongchieu = pc.id_phongchieu join phim p on sc.id_phim = p.id_phim where r.id_rap = ? and sc.date_show >= CURDATE() and sc.deleted = 0");
		$res->bind_param("i", $id_rap);
		$res->execute();
		$data = [];
		$info = $res->get_result();
		while ($row = $info->fetch_assoc()) {
			$data[] = $row;
		}
		return json_encode($data);
	}
	// Hàm kiểm tra xem suất chiếu thêm mới vào có nằm trong khoảng suất chiếu hiện đang có không
	public function checkTrungSuatChieu($suatchieu_check, $phongchieu_check, $ngaychieu_check, $duration_check) {
		$res = $this->db->prepare("select check_suatchieu(?, ?, ?, ?) as kq");
		$res->bind_param("sisi", $suatchieu_check, $phongchieu_check, $ngaychieu_check, $duration_check);
		$res->execute();
		$result = $res->get_result();
		$data = $result->fetch_assoc();
		return json_encode($data);
	}
	public function insert($id_phim, $id_rap, $id_loaive, $id_phongchieu, $dateshow, $timeshow) {
		$res = $this->db->prepare("insert into suatchieu (id_phim, id_rap, id_loaive, id_phongchieu, date_show, time_show) values(?,?,?,?,?,?)");
		$res->bind_param("iiiiss", $id_phim, $id_rap, $id_loaive, $id_phongchieu, $dateshow, $timeshow);
		$res->execute();
		return $res->affected_rows;
	}
	public function delete($id_suatchieu) {
		$res = $this->db->prepare("update suatchieu set deleted=1 where id_suatchieu =?");
        $res->bind_param("i", $id_suatchieu);
        $res->execute();
        return $res->affected_rows;
	}
}
