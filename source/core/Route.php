<?php
class Route {
	function handleRoute($url) {
		global $routes;

		// print_r($routes);
		unset($routes['default_controller']);
		$url = trim($url, '/');
		$handleUrl = $url;
		// Kiem tra xem route co du lieu hay khong
		if(!empty($routes)) {
			foreach ($routes as $key => $value) {
				if(preg_match('~'.$key.'~is', $url)) {
					// var_dump($key);
					$handleUrl = preg_replace('~'.$key.'~is', $value, $url);
				};
			}
		}
		return $handleUrl;
	}
}

