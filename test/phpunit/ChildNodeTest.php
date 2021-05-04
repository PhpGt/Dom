<?php
namespace Gt\Dom\Test;

use Exception;
use Gt\Dom\Test\TestFactory\NodeTestFactory;
use PHPUnit\Framework\TestCase;
use Throwable;

class ChildNodeTest extends TestCase {
	public function testRemoveNoParent():void {
		$sut = NodeTestFactory::createHTMLElement("div");
		$exception = null;
		try {
			$sut->remove();
		}
		catch(Throwable $exception) {}
		self::assertNull($exception);
	}

	public function testRemove():void {
		$sut = NodeTestFactory::createHTMLElement("div");
		$parent = $sut->ownerDocument->createElement("example-parent");
		$parent->appendChild($sut);
		self::assertSame($parent, $sut->parentElement);
		$sut->remove();
		self::assertNull($sut->parentElement);
	}
}
