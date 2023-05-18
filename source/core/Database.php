<?php
	class Database {
		public $__conn;
		function __construct() {
			global $db_config;
			$this->__conn = Connection::getInstance($db_config);
		}
		// function query($sql) {
		// 	try {
		// 		$statement = $this->__conn->prepare($sql);
		// 		$statement->execute();
		// 	} catch (Exception $exc) {
		// 		$mess = $exc->getMessage();
		// 		die($mess);
		// 	}
		// 	// $statement->bind_result($id, $name);
		// 	// while ($statement->fetch()) {
		// 	// 	echo 'ID: '.$id.'<br>';
		// 	// 	echo 'First Name: '.$name.'<br>';
		// 	// }
		// 	return $statement;
		// }
	}

?>