<?php
namespace Gt\Dom\Test;

use Gt\Dom\Test\TestFactory\NodeTestFactory;
use PHPUnit\Framework\TestCase;

class TextTest extends TestCase {
	public function testIsElementContentWhitespaceEmptyContent():void {
		$sut = NodeTestFactory::createTextNode("");
		self::assertTrue($sut->isElementContentWhitespace);
	}

	public function testIsElementContentWhitespaceNonEmptyContent():void {
		$sut = NodeTestFactory::createTextNode("Hello, World");
		self::assertFalse($sut->isElementContentWhitespace);
	}

	public function testIsElementContentWhitespaceJustSpacesAndTabsContent():void {
		$sut = NodeTestFactory::createTextNode("   		  
			          
  	                ");
		self::assertTrue($sut->isElementContentWhitespace);
	}
}
