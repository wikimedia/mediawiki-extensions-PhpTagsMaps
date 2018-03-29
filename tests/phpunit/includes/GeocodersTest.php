<?php

namespace MultiMaps;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-03-05 at 09:57:11.
 */
class GeocodersTest extends \PHPUnit\Framework\TestCase {

	/**
	 * @var Geocoders
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new Geocoders;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
	}

	public function testReturnFalseOnUnknownService() {
		$this->assertFalse(
			$this->object->getCoordinates( '', '' )
		);
		$this->assertFalse(
			$this->object->getCoordinates( '', 'blablabla' )
		);
	}

}
