<?php

namespace MultiMaps;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-02-25 at 09:41:30.
 */
class GoogleTest extends \PHPUnit\Framework\TestCase {

	/**
	 * @var Google
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new Google;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {

	}

	public function testParseGeocoderMarker() {
		$this->assertRegExp(
				'{"markers":[{"pos":[{"lat":[0-9\.]+,"lon":[0-9\.]+}]}],"bounds":{"ne":{"lat":[0-9\.]+,"lon":[0-9\.]+},"sw":{"lat":[0-9\.]+,"lon":[0-9\.]+}}}',
				\FormatJson::encode( $this->object->getMapData( array('Moscow', 'service=google') ) )
				);
	}

	public function testParseGeocoderRectangle() {
		$this->assertRegExp(
				'{"rectangles":\[{"pos":\[{"lat":[0-9\.]+,"lon":[0-9\.]+},{"lat":[0-9\.]+,"lon":[0-9\.]+}\]}\],"bounds":{"ne":{"lat":[0-9\.]+,"lon":[0-9\.]+},"sw":{"lat":[0-9\.]+,"lon":[0-9\.]+}}}',
				\FormatJson::encode( $this->object->getMapData( array('rectangle=Moscow', 'service=google') ) )
				);
	}

	public function testParseGeocoderRectangles() {
		$this->assertRegExp(
				'{"rectangles":\[{"pos":\[{"lat":[0-9\.]+,"lon":[0-9\.]+},{"lat":[0-9\.]+,"lon":[0-9\.]+}\]},{"pos":\[{"lat":[0-9\.]+,"lon":[0-9\.]+},{"lat":[-0-9\.]+,"lon":[-0-9\.]+}]}],"bounds":{"ne":{"lat":[0-9\.]+,"lon":[0-9\.]+},"sw":{"lat":[0-9\.]+,"lon":[-0-9\.]+}}}',
				\FormatJson::encode( $this->object->getMapData( array('rectangle=Moscow;London', 'service=google') ) )
				);
	}

	public function testParseGeocoderCircle() {
		$this->assertRegExp(
				'{"circles":\[{"radius":\[[0-9\.]+\],"pos":\[{"lat":[0-9\.]+,"lon":[0-9\.]+}\]}\],"bounds":{"ne":{"lat":[0-9\.]+,"lon":[0-9\.]+},"sw":{"lat":[0-9\.]+,"lon":[0-9\.]+}}}',
				\FormatJson::encode( $this->object->getMapData( array('circle=Moscow', 'service=google') ) )
				);
	}

}
