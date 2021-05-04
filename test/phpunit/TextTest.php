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

	public function testWholeTextEmpty():void {
		$sut = NodeTestFactory::createTextNode();
		self::assertSame("", $sut->wholeText);
	}

	public function testWholeTextSingle():void {
		$sut = NodeTestFactory::createTextNode("test");
		self::assertSame("test", $sut->wholeText);
	}

	public function testWholeTextSiblings():void {
		$sut = NodeTestFactory::createTextNode("test");
		$test1 = $sut->ownerDocument->createTextNode("one");
		$test2 = $sut->ownerDocument->createTextNode("two");
		$parent = $sut->ownerDocument->createElement("test-parent");
		$parent->append($test1, $sut, $test2);
		self::assertSame("onetesttwo", $sut->wholeText);
	}
}
