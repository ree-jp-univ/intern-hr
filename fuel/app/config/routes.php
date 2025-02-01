<?php
return array(
	'_root_'  => function(){	// The default route
		return \Fuel\Core\Request::forge('home/index')->execute();
	},
	'_404_'   => function(){	// The main 404 route
		$view = array();
		$view['header'] = \Fuel\Core\View::forge('header');
		$view['content'] = \Fuel\Core\View::forge('404');
		$view['footer'] = \Fuel\Core\View::forge('footer');
		echo \Fuel\Core\View::forge('layout', $view);
	},
);
