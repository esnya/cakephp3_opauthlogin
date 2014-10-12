<?php
namespace Opauth\Controller;

use Opauth\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Routing\Router;
use Cake\Utility\Security;

/**
 * Opauth Controller
 *
 * @property Opauth\Model\Table\OpauthTable $Opauth
 */
class OpauthController extends AppController {
	public function beforeFilter(Event $event) {
		$this->Auth->allow();
	}

	public function login($provider = null) {
		if ($provider) {
			$config = [
				'path' => Router::url(['action' => 'login']) . '/',
				'callback_url' => Router::url(['action' => 'postlogin']),
				'security_salt' => Security::salt(),
				'Strategy' => Configure::read('OpauthStrategy'),
			];
			$opauth = new \Opauth($config, true);
		} else {
			throw new NotFoundException();
		}
	}

	public function postlogin() {
		session_start();
		return $this->redirect($this->Auth->redirectUrl());
	}
}
