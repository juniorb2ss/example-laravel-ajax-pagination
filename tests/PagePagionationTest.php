<?php

class PagePagionationTest extends TestCase {

	/**
	 * Test json data
	 */
	public function testJsonDataPayload() {
		$this->get('/users')
			->seeJson();
	}

	/**
	 * @depends testJsonDataPayload
	 */
	public function testIntranetIsGorgeous() {
		// try test page?
	}
}
