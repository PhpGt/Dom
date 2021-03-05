<?php
namespace Gt\Dom\Test;

use Gt\Dom\Facade\DOMTokenListFactory;
use PHPUnit\Framework\TestCase;

class DOMTokenListTest extends TestCase {
	public function testLength():void {
		$data = ["one", "two", "three"];
		$sut = DOMTokenListFactory::create(fn() => $data);
		self::assertEquals(
			count($data),
			$sut->length
		);
	}

	public function testCount():void {
		$data = ["one", "two", "three"];
		$sut = DOMTokenListFactory::create(fn() => $data);
		self::assertCount(
			count($data),
			$sut
		);
	}

	public function testValue():void {
		$data = ["one", "two", "three"];
		$sut = DOMTokenListFactory::create(fn() => $data);
		self::assertEquals(
			implode(" ", $data),
			$sut->value
		);
	}
}
