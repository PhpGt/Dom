<?php
namespace Gt\Dom\Test;

use Gt\Dom\Facade\DOMTokenListFactory;
use PHPUnit\Framework\TestCase;

class DOMTokenListTest extends TestCase {
	public function testLength():void {
		$data = ["one", "two", "three"];
		$sut = DOMTokenListFactory::create(fn() => $data, fn() => null);
		self::assertEquals(
			count($data),
			$sut->length
		);
	}

	public function testCount():void {
		$data = ["one", "two", "three"];
		$sut = DOMTokenListFactory::create(fn() => $data, fn() => null);
		self::assertCount(
			count($data),
			$sut
		);
	}

	public function testValueAccessor():void {
		$data = ["one", "two", "three"];
		$sut = DOMTokenListFactory::create(fn() => $data, fn() => null);
		self::assertEquals(
			implode(" ", $data),
			$sut->value
		);
	}

	public function testValueMutator():void {
		$data = ["one", "two", "three"];
		$sut = DOMTokenListFactory::create(fn() => $data, fn() => null);
		$sut->value = "four five six";
		self::assertEquals(
			"four five six",
			$sut->value
		);
	}

	public function testItem():void {
		$data = ["one", "two", "three"];
		$sut = DOMTokenListFactory::create(fn() => $data, fn() => null);
		for($i = 0; $i < count($data); $i++) {
			self::assertEquals(
				$data[$i],
				$sut->item($i)
			);
		}
	}

	public function testContains():void {
		$data = ["one", "two", "three"];
		$sut = DOMTokenListFactory::create(fn() => $data, fn() => null);
		self::assertTrue($sut->contains("one"));
		self::assertTrue($sut->contains("two"));
		self::assertTrue($sut->contains("three"));
		self::assertFalse($sut->contains("four"));
	}
}