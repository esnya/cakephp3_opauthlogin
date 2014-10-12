<?php
namespace Opauth\Test\TestCase\View\Helper;

use Cake\View\View;
use Opauth\View\Helper\OpauthHelper;
use Cake\TestSuite\TestCase;

/**
 * Opauth\View\Helper\OpauthHelper Test Case
 */
class OpauthHelperTest extends TestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$view = new View();
		$this->Opauth = new OpauthHelper($view);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Opauth);

		parent::tearDown();
	}

}
