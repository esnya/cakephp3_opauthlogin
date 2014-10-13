<?php
namespace OpauthLogin\Controller;

use OpauthLogin\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Routing\Router;
use Cake\Utility\Security;
use Cake\Utility\Inflector;

/**
 * OpauthLogin Controller
 *
 * @property OpauthLogin\Model\Table\OpauthLoginTable $OpauthLogin
 */
class OpauthLoginController extends AppController {
	public $components = ['Session'];

	public function beforeFilter(Event $event) {
		$this->Auth->allow();
	}

	public function login($provider = null) {
		if ($provider) {
			$config = [
				'path' => Router::url(['action' => 'login']) . '/',
				'callback_url' => Router::url(['action' => 'callback']),
				'security_salt' => Security::salt(),
				'Strategy' => Configure::read('OpauthStrategy'),
			];
			$opauth = new \Opauth($config, true);
		} else {
			throw new NotFoundException();
		}
	}

	public function callback() {
		session_start();

		$oauthLogin = $this->Auth->getAuthenticate('OpauthLogin.OpauthLogin');

		$registrationUrl = $oauthLogin->getRegistrationUrl();

		if (!$oauthLogin->getUser(null) && $registrationUrl && $this->Session->read('opauth.auth.uid')) {
			return $this->redirect($registrationUrl);
		} else {
			return $this->redirect($this->Auth->redirectUrl());
		}
	}
}
