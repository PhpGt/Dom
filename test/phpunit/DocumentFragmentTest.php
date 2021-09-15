<?php
namespace Gt\Dom\Test;

use Gt\Dom\DocumentFragment;
use Gt\Dom\Test\TestFactory\NodeTestFactory;
use PHPUnit\Framework\TestCase;

class DocumentFragmentTest extends TestCase {
	public function testGetElementByIdEmpty():void {
		$sut = NodeTestFactory::createFragment();
		self::assertNull($sut->getElementById("nothing"));
	}

	public function testGetElementById():void {
		$sut = NodeTestFactory::createFragment();
		$nodeWithId = $sut->ownerDocument->createElement("div");
		$nodeWithId->id = "test";
		$sut->appendChild($nodeWithId);
		self::assertSame($nodeWithId, $sut->getElementById("test"));
	}
}
