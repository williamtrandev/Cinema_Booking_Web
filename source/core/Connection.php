<?php
	class Connection
	{
		private static $instance = null, $conn = null;
		private function __construct($config)
		{
			// Ket noi database
			$conn = new mysqli($config['host'], $config['user'], $config['pass'], $config['db']);
			if($conn->connect_error) {
				die("Connection failed");	// Die khi ket noi that bai
			}
			self::$conn = $conn;
		}
		public static function getInstance($config) {
			if(self::$instance == null) {
				$connect = new Connection($config);	// Tao ket noi database khi chua co ket noi
				self::$instance = self::$conn;
			}
			return self::$instance;
		}

	}
	

?>