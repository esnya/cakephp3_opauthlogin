<?php
namespace Opauth\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Opauth helper
 */
class OpauthHelper extends Helper {
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
			['plugin' => 'Opauth', 'controller' => 'opauth', 'action' => 'login', $provider],
			$options
		);
	}	
}
