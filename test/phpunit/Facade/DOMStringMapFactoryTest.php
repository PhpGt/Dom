<?php

namespace Facade;

use Gt\Dom\Element;
use Gt\Dom\Facade\DOMStringMapFactory;
use PHPUnit\Framework\TestCase;

class DOMStringMapFactoryTest extends TestCase {
	public function testCreateDatasetWithoutDataAttributes():void {
		$attributeArray = [
			"id" => "example",
			"class" => "phpunit",
		];
		$element = self::createMock(Element::class);
		$element->method("__get")
			->with("attributes")
			->willReturn($attributeArray);
		$domStringMap = DOMStringMapFactory::createDataset($element);
		self::assertEmpty($domStringMap);
	}

	public function testCreateDatasetWithDataAttribute():void {
		$attributeArray = [
			"id" => "example",
			"data-language" => "php",
			"class" => "phpunit",
		];
		$element = self::createMock(Element::class);
		$element->method("__get")
			->with("attributes")
			->willReturn($attributeArray);
		$domStringMap = DOMStringMapFactory::createDataset($element);
		self::assertNotEmpty($domStringMap);
		self::assertEquals("php", $domStringMap->language);
	}

	public function testCreateDatasetMutate():void {
		$attributeArray = [
			"id" => "example",
			"data-language" => "php",
			"class" => "phpunit",
		];
		$element = self::createMock(Element::class);
		$element->method("__get")
			->with("attributes")
			->willReturn($attributeArray);
		$element->method("getAttribute")
			->with("data-language")
			->willReturnOnConsecutiveCalls("php");
		$domStringMap = DOMStringMapFactory::createDataset($element);

		$element->expects(self::once())
			->method("setAttribute")
			->with("data-language", "python");
		$domStringMap->language = "python";
	}

	public function testCreateDatasetAccessWithoutMutate():void {
		$attributeArray = [
			"id" => "example",
			"data-language" => "php",
			"class" => "phpunit",
		];
		$element = self::createMock(Element::class);
		$element->method("__get")
			->with("attributes")
			->willReturn($attributeArray);
		$element->expects(self::exactly(2))
			->method("getAttribute")
			->with("data-language")
			->willReturnOnConsecutiveCalls("php", "python");
		$element->expects(self::once())
			->method("setAttribute")
			->with("data-language", "python");
		$domStringMap = DOMStringMapFactory::createDataset($element);
		$domStringMap->language = "python";
		$domStringMap->language = "python";
	}
}
