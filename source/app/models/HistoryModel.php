<?php
class HistoryModel extends BaseModel
{
	// Lấy số lượng phim đã được mua
	public function getAll()
	{
		$res = $this->db->query("select count(distinct sc.id_phim) as soluong from lichsu ls join suatchieu sc on ls.id_suatchieu = sc.id_suatchieu");
		$row = $res->fetch_assoc();
		return json_encode($row);
	}
	// Insert dữ liệu vào khi có khách hàng đặt vé
	public function insert($id_khachhang, $id_suatchieu, $num_ticket, $seat, $total_price)
	{
		$res = $this->db->prepare("insert into lichsu (id_khachhang, id_suatchieu, num_ticket, seat, total_price) values (?,?,?,?,?)");
		$res->bind_param('iiisi', $id_khachhang, $id_suatchieu, $num_ticket, $seat, $total_price);
		$res->execute();
		if ($res->affected_rows > 0) {
			return true;
		}
		return false;
	}
	// Lấy các vé đã đặt của khách hàng
	public function getAllTicketById($id_khachhang)
	{
		$res = $this->db->prepare("select * from lichsu ls join suatchieu sc on ls.id_suatchieu = sc.id_suatchieu join phim p on sc.id_phim = p.id_phim where id_khachhang=?");
		$res->bind_param('i', $id_khachhang);
		$res->execute();
		$result = $res->get_result();
		$data = [];
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
		return json_encode($data);
	}
	// Lấy số lượng vé đã đặt của khách hàng
	public function getNumberTicketById($id_khachhang)
	{
		$res = $this->db->prepare("select sum(num_ticket) as soluong from lichsu where id_khachhang=?");
		$res->bind_param('i', $id_khachhang);
		$res->execute();
		$result = $res->get_result();
		$row = $result->fetch_assoc();
		return json_encode($row);
	}
	// Hàm thống kê số lượng, tổng tiền theo từng phim theo ngày, tháng hoặc năm
	public function getStatistic($dateStart, $dateEnd, $page)
	{
		$offset = ($page - 1) * 10;
		$res = $this->db->query("select p.name_phim, SUM(ls.num_ticket) as soluong, SUM(ls.total_price) as tongtien from lichsu ls join suatchieu sc on ls.id_suatchieu = sc.id_suatchieu join phim p on sc.id_phim = p.id_phim where ngaylap between '$dateStart' and '$dateEnd' group by p.name_phim order by SUM(ls.num_ticket) limit $offset, 10");
		$data = [];
		while ($row = $res->fetch_assoc()) {
			$data[] = $row;
		}
		return json_encode($data);
	}
	// Lấy tổng doanh thu theo ngày, tháng hoặc năm
	public function getTotalRevenue($dateStart, $dateEnd)
	{
		$res = $this->db->prepare("select SUM(total_price) as tongtien from lichsu where ngaylap between ? and ?");
		$res->bind_param("ss", $dateStart, $dateEnd);
		$res->execute();
		$result = $res->get_result();
		$row = $result->fetch_assoc();
		return json_encode($row);
	}
	public function getAllHistory($page)
	{
		$offset = ($page - 1) * 10;
		$res = $this->db->query("select * from lichsu ls join suatchieu sc on ls.id_suatchieu = sc.id_suatchieu join phim p on p.id_phim = sc.id_phim join khachhang kh on kh.id_khachhang = ls.id_khachhang order by ngaylap desc limit $offset, 10");
		$data = [];
		while ($row = $res->fetch_assoc()) {
			$data[] = $row;
		}
		return json_encode($data);
	}
	public function getNumberHistory()
	{
		$res = $this->db->query("select count(*) as soluong from lichsu ls join suatchieu sc on ls.id_suatchieu = sc.id_suatchieu join phim p on p.id_phim = sc.id_phim join khachhang kh on kh.id_khachhang = ls.id_khachhang order by ngaylap desc");
		$row = $res->fetch_assoc();
		return json_encode($row);
	}
}
