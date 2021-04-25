<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLOrForeignElementTest extends HTMLElementTestCase {
	public function testDatasetEmpty():void {
		$sut = NodeTestFactory::createHTMLElement("div");
		self::assertEmpty($sut->dataset);
		self::assertCount(0, $sut->dataset);
		self::assertNull($sut->dataset->nothing);
	}

	public function testDatasetSetsDataAttribute():void {
		$sut = NodeTestFactory::createHTMLElement("div");
		$sut->dataset->example = "something";
		self::assertEquals("something", $sut->getAttribute("data-example"));
	}
}
