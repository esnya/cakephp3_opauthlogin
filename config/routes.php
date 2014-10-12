<?php
use Cake\Routing\Router;

Router::plugin('OpauthLogin', function($routes) {
	$routes->fallbacks();
});
