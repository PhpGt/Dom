<?php
namespace Gt\Dom\Test;

use Gt\Dom\DOMStringMapFactory;
use Gt\Dom\Element;
use Gt\Dom\HTMLDocument;
use PHPUnit\Framework\TestCase;

class DOMStringMapFactoryTest extends TestCase {
	public function testCreateDatasetWithoutDataAttributes():void {
		$attributeArray = [
			"id" => "example",
			"class" => "phpunit",
		];
		$document = new HTMLDocument();
		$element = $document->createElement("example-element");
		foreach($attributeArray as $key => $value) {
			$element->setAttribute($key, $value);
		}

		$domStringMap = DOMStringMapFactory::createDataset($element);
		self::assertEmpty($domStringMap);
	}

	public function testCreateDatasetWithDataAttribute():void {
		$attributeArray = [
			"id" => "example",
			"data-language" => "php",
			"class" => "phpunit",
		];
		$document = new HTMLDocument();
		$element = $document->createElement("example-element");
		foreach($attributeArray as $key => $value) {
			$element->setAttribute($key, $value);
		}
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
		$document = new HTMLDocument();
		$element = $document->createElement("example-element");
		foreach($attributeArray as $key => $value) {
			$element->setAttribute($key, $value);
		}
		$domStringMap = DOMStringMapFactory::createDataset($element);
		$domStringMap->set("language", "python");
		self::assertEquals("python", $domStringMap->get("language"));
	}

	public function testCreateDatasetAccessWithoutMutate():void {
		$attributeArray = [
			"id" => "example",
			"data-language" => "php",
			"class" => "phpunit",
		];
		$document = new HTMLDocument();
		$element = $document->createElement("example-element");
		foreach($attributeArray as $key => $value) {
			$element->setAttribute($key, $value);
		}

		$domStringMap = DOMStringMapFactory::createDataset($element);
		self::assertSame("php", $domStringMap->get("language"));
		$domStringMap->set("language", "python");
		self::assertSame("python", $domStringMap->get("language"));
	}

	public function testSettingSameValue():void {
		$attributeArray = [
			"id" => "example",
			"data-language" => "php",
			"class" => "phpunit",
		];
		$document = new HTMLDocument();
		$element = $document->createElement("example-element");
		foreach($attributeArray as $key => $value) {
			$element->setAttribute($key, $value);
		}

		$domStringMap = DOMStringMapFactory::createDataset($element);
		$domStringMap->set("language", "php");
		self::assertSame("php", $domStringMap->get("language"));
	}
}
