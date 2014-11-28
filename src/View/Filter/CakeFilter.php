<?php

namespace Gourmet\Liquid\View\Filter;

class CakeFilter {

	public function url($route) {
		return \Cake\Routing\Router::url((array) json_decode($route));
	}
	
}
