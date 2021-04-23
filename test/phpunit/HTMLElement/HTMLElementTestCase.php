<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLElement;
use Gt\Dom\HTMLElement\HTMLImageElement;
use PHPUnit\Framework\TestCase;

class HTMLElementTestCase extends TestCase {
	protected function assertPropertyAttributeCorrelate(
		HTMLElement $element,
		string $attribute,
		string $property = null
	):void {
		if(is_null($property)) {
			$property = $attribute;
		}

		self::assertEquals(
			"",
			$element->getAttribute($attribute)
		);
		self::assertEquals(
			$element->$property,
			$element->getAttribute($attribute)
		);

		$value = uniqid();
		$element->setAttribute($attribute, $value);
		self::assertEquals(
			$value,
			$element->getAttribute($attribute)
		);
		self::assertEquals(
			$element->$property,
			$element->getAttribute($attribute)
		);

		$value2 = uniqid();
		$element->$property = $value2;
		self::assertEquals(
			$value2,
			$element->getAttribute($attribute)
		);
		self::assertEquals(
			$element->$property,
			$element->getAttribute($attribute)
		);
	}

	protected static function assertPropertyAttributeCorrelateBool(
		HTMLElement $sut,
		string $attribute,
		string $property = null
	):void {
		if(is_null($property)) {
			$property = $attribute;
		}

		$current = $sut->$property;
		self::assertIsBool($current);

		$sut->$property = !$current;
		self::assertSame(!$current, $sut->$property);

		if($current) {
			self::assertFalse($sut->hasAttribute($attribute));
		}
		else {
			self::assertTrue($sut->hasAttribute($attribute));
		}

		$sut->$property = $current;
		self::assertSame($current, $sut->$property);

		if($current) {
			self::assertTrue($sut->hasAttribute($attribute));
		}
		else {
			self::assertFalse($sut->hasAttribute($attribute));
		}
	}

	protected static function assertPropertyAttributeCorrelateNullableInt(
		HTMLElement $sut,
		string $attribute,
		string $property = null
	):void {
		if(is_null($property)) {
			$property = $attribute;
		}

		$current = $sut->$property;
		self::assertEquals($current, $sut->getAttribute("attribute"));

		for($i = 0; $i < 10; $i++) {
			$value = rand(1, 999999);
			$sut->setAttribute($attribute, (string)$value);
			self::assertEquals($sut->$property, $sut->getAttribute($attribute));
		}

		for($i = 0; $i < 10; $i++) {
			$value = rand(1, 999999);
			$sut->$property = $value;
			self::assertEquals($sut->getAttribute($attribute), $sut->$property);
		}
	}
}
