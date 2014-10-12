<?php
namespace OpauthLogin\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * OpauthLogin helper
 */
class OpauthLoginHelper extends Helper {
	public $helpers = ['Html'];
/**
 * Default configuration.
 *
 * @var array
 */
	protected $_defaultConfig = [];

	public function login($label, $provider, $options = []) {
		return $this->Html->link(
			$label,
			['plugin' => 'OpauthLogin', 'controller' => 'opauth_login', 'action' => 'login', $provider],
			$options
		);
	}	
}
