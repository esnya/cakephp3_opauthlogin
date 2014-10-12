<?php
namespace OpauthLogin\Test\TestCase\View\Helper;

use Cake\View\View;
use OpauthLogin\View\Helper\OpauthLoginHelper;
use Cake\TestSuite\TestCase;

/**
 * OpauthLogin\View\Helper\OpauthLoginHelper Test Case
 */
class OpauthLoginHelperTest extends TestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$view = new View();
		$this->OpauthLogin = new OpauthLoginHelper($view);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->OpauthLogin);

		parent::tearDown();
	}

}
