<?php
namespace Gt\Dom\Test;

use Gt\Dom\Facade\DOMTokenListFactory;
use PHPUnit\Framework\TestCase;

class DOMTokenListTest extends TestCase {
	public function testLength():void {
		$example = ["one", "two", "three"];
		$sut = DOMTokenListFactory::create(fn() => $example);
		self::assertEquals(
			count($example),
			$sut->length
		);
	}

	public function testCount():void {
		$example = ["one", "two", "three"];
		$sut = DOMTokenListFactory::create(fn() => $example);
		self::assertCount(
			count($example),
			$sut
		);
	}
}
