<?php
class App {
	private $__controller, $__action, $__params, $__routes;
	function __construct()
	{
		global $routes, $configs;  // Khai bao bien toan cuc de dung
		// Neu default controller khong duoc cau hinh thi khong gan
		$this->__routes = new Route();
		if(!empty($routes['default_controller'])) {
			$this->__controller = $routes['default_controller'];
		}
		$this->__action = 'index';
		$this->__params = [];
		$url = $this->handleURL();
	}
	// Ham lay url
	function getURL() {
		if(!empty($_SERVER['PATH_INFO'])) {
			$url = $_SERVER['PATH_INFO'];
		} else {
			$url = '/';
		}
		return $url;
	}
	public function handleURL() {
		$url = $this->getURL();
		$url = $this->__routes->handleRoute($url);
		$urlArr = array_filter(explode('/',$url));
		$urlArr = array_values($urlArr); // Ep urlArray ve dang index tu 0
		
		// Xu ly controller
		if(!empty($urlArr[0])) {
			$this->__controller = ucfirst($urlArr[0]) . 'Controller';
		} else {
			$this->__controller = ucfirst($this->__controller) . 'Controller';
		}
		$pathController = 'app/controllers/' . ($this->__controller) . '.php';
		if(file_exists($pathController)) {
			require_once $pathController;

			// Kiem tra class controller co ton tai hay khong
			if(class_exists($this->__controller)) {
				$this->__controller = new $this->__controller(); // khoi tao doi tuong de dung method
				unset($urlArr[0]);
			} else {
				$this->loadError();
			}
		} else {
			$this->loadError();
		}

		// Xu ly action
		if(!empty($urlArr[1])) {
			$this->__action = $urlArr[1];
			unset($urlArr[1]);
		} 

		// Xu ly params 
		$this->__params = array_values($urlArr); // Bien mang tro lai tu index 0

		// Kiem tra method co ton tai hay khong
		if(method_exists($this->__controller, $this->__action)) {
			call_user_func_array([$this->__controller, $this->__action], $this->__params);
		} else {
			$this->loadError();
		}
		
	}
	public function loadError($name='404') {
		require_once 'errors/' . $name . '.php';
	}
}	