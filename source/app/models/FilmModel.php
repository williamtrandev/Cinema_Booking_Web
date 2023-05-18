<?php
class FilmModel extends BaseModel
{
	protected $_table = 'phim';
	public function getShowingFilmList($option = "")
	{
		$data = $this->db->query("select p.*, np.name_nhanphim from phim p join nhanphim np on p.id_nhanphim=np.id_nhanphim where p.is_coming=0 and p.deleted=0 order by id_phim $option");
		$films = [];
		while ($row = $data->fetch_assoc()) {
			$films[] = $row;
		}
		return json_encode($films);
	}
	public function getDetail($id)
	{
		$data = $this->db->prepare("select p.*, np.name_nhanphim from phim p join nhanphim np on p.id_nhanphim=np.id_nhanphim where p.id_phim = ?");
		$data->bind_param("i", $id);
		$data->execute();
		$film = $data->get_result()->fetch_assoc();
		return json_encode($film);
	}
	public function getComingFilmList($option = "")
	{
		$data = $this->db->query("select p.*, np.name_nhanphim from phim p join nhanphim np on p.id_nhanphim=np.id_nhanphim where p.is_coming=1 and p.deleted=0 $option");
		$films = [];
		while ($row = $data->fetch_assoc()) {
			$films[] = $row;
		}
		return json_encode($films);
	}
	public function getAllFilm3D()
	{
		$data = $this->db->query("select p.*, np.name_nhanphim from phim p join nhanphim np on p.id_nhanphim=np.id_nhanphim where p.is_coming=0 and p.deleted=0 and p.phim_3d=1");
		$films = [];
		while ($row = $data->fetch_assoc()) {
			$films[] = $row;
		}
		return json_encode($films);
	}
	public function getAllFilm3DComing()
	{
		$data = $this->db->query("select p.*, np.name_nhanphim from phim p join nhanphim np on p.id_nhanphim=np.id_nhanphim where p.is_coming=1 and p.deleted=0 and p.phim_3d=1");
		$films = [];
		while ($row = $data->fetch_assoc()) {
			$films[] = $row;
		}
		return json_encode($films);
	}
	public function getAllFilm()
	{
		$data = $this->db->query("select p.*, np.name_nhanphim from phim p join nhanphim np on p.id_nhanphim=np.id_nhanphim where p.is_coming=0 and p.deleted=0");
		$films = [];
		while ($row = $data->fetch_assoc()) {
			$films[] = $row;
		}
		return json_encode($films);
	}
	public function getAllFilmByName($name)
	{
		$name = "%$name%";
		$data = $this->db->prepare("select p.*, np.name_nhanphim from phim p join nhanphim np on p.id_nhanphim=np.id_nhanphim where p.is_coming=0 and p.deleted=0 and name_phim like ?");
		$data->bind_param("s", $name);
		$data->execute();
		$result = $data->get_result();
		$films = [];
		while ($row = $result->fetch_assoc()) {
			$films[] = $row;
		}
		return json_encode($films);
	}
	public function getAllFilmShowingAndComing()
	{
		$data = $this->db->query("select p.*, np.name_nhanphim from phim p join nhanphim np on p.id_nhanphim=np.id_nhanphim where p.deleted=0");
		$films = [];
		while ($row = $data->fetch_assoc()) {
			$films[] = $row;
		}
		return json_encode($films);
	}
	public function getDuration($id_phim)
	{
		$res = $this->db->prepare("select duration from phim where id_phim=?");
		$res->bind_param('i', $id_phim);
		$res->execute();
		$result = $res->get_result();
		return json_encode($result->fetch_assoc());
	}
	public function updateFilm($id_phim, $name_phim, $is_coming, $id_loaive, $id_nhanphim, $duration, $director, $actors, $release_date, $description, $image_path, $trailer_path)
	{
		if($image_path == '') {
			$res = $this->db->prepare("update phim set name_phim=?, phim_3d=?, id_nhanphim=?, duration=?, director=?, actors=?, release_date=?, description=?, trailer_path=?, is_coming=? where id_phim=?");
			$res->bind_param('siiisssssii', $name_phim, $id_loaive, $id_nhanphim, $duration, $director, $actors, $release_date, $description, $trailer_path, $is_coming, $id_phim);
			$res->execute();
		} else {
			$res = $this->db->prepare("update phim set name_phim=?, phim_3d=?, id_nhanphim=?, duration=?, director=?, actors=?, release_date=?, description=?, image_path=?, trailer_path=?, is_coming=? where id_phim=?");
			$res->bind_param('siiissssssii', $name_phim, $id_loaive, $id_nhanphim, $duration, $director, $actors, $release_date, $description, $image_path, $trailer_path, $is_coming, $id_phim);
			$res->execute();
		}
		return $res->affected_rows;
	}
	public function insert($name_phim, $director, $actors, $id_nhanphim, $release_date, $duration, $description, $is_coming, $image_path, $trailer_path, $phim_3d) {
		$res = $this->db->prepare("insert into phim (name_phim, director, actors, id_nhanphim, release_date, duration, description, is_coming, image_path, trailer_path, phim_3d) values(?,?,?,?,?,?,?,?,?,?,?)");
		$res->bind_param('sssisisissi', $name_phim, $director, $actors, $id_nhanphim, $release_date, $duration, $description, $is_coming, $image_path, $trailer_path, $phim_3d);
		$res->execute();
		return $res->affected_rows;
	}
	public function delete($id_phim) {
		$res = $this->db->prepare("update phim set deleted=1 where id_phim=?");
        $res->bind_param('i', $id_phim);
        $res->execute();
        return $res->affected_rows;
	}
}
