<?php
use Cake\Routing\Router;

Router::plugin('Opauth', function($routes) {
	$routes->fallbacks();
});
