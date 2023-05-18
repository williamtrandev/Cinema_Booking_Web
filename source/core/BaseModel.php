<?php
	class BaseModel extends Database {
		protected $db, $table;
		function __construct()
		{
			$this->db = (new Database())->__conn;
		}
		function setTable($table) {
			$this->table = $table;
		}
	}
?>