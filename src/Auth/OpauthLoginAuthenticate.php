<?php
	namespace OpauthLogin\Auth;

	use Cake\Auth\BaseAuthenticate;
	use Cake\Network\Request;
	use Cake\Network\Response;
	use Cake\Utility\Hash;
	use Cake\ORM\TableRegistry;

	class OpauthLoginAuthenticate extends BaseAuthenticate {
		public function authenticate(Request $request, Response $response) {
			return getUser($request);
		}

		public function getUser(Request $request) {
			if (!isset($_SESSION)) {
				return false;
			}

			$provider = Hash::get($_SESSION, 'opauth.auth.provider');
			if (!$provider) {
				return false;
			}

			$uid = Hash::get($_SESSION, 'opauth.auth.uid');
			if (!$uid) {
				return false;
			}

			$userModel = $this->_config['userModel'];
			list(, $model) = pluginSplit($userModel);
			$fields = $this->_config['fields'];

			$conditions = [$model . '.provider' => $provider, $model . '.uid' => $uid];

			$scope = $this->_config['scope'];
			if ($scope) {
				$conditions = array_merge($conditions, $scope);
			}

			$table = TableRegistry::get($userModel)->find('all');

			$contain = $this->_config['contain'];
			if ($contain) {
				$table = $table->contain($contain);
			}

			$result = $table
			->where($conditions)
			->hydrate(false)
			->first();

			if (empty($result)) {
				return false;
			}
			
			return $result;
		}
	}
