<?php
namespace Gt\Dom\Test;

use Gt\Dom\Test\TestFactory\DocumentTestFactory;
use PHPUnit\Framework\TestCase;

class DOMImplementationTest extends TestCase {
	public function testHasFeature():void {
		$sut = DocumentTestFactory::createDOMImplementation();
		self::assertTrue($sut->hasFeature("anything", "anything"));
	}
}
