<?php
namespace Gt\Dom\Test;

use Gt\Dom\Element;
use Gt\Dom\HTMLDocument;
use Gt\Dom\NodeList;
use Gt\Dom\Test\Helper\Helper;
use PHPUnit\Framework\TestCase;

class NodeListTest extends TestCase {
	public function testNodeListFunctionsReturnGtObjects() {
		$objectsThatShouldBeNodeList = [];
		$document = new HTMLDocument(Helper::HTML_MORE);

		$objectsThatShouldBeNodeList["tag-name"] = $document->getElementsByTagName("p");

		foreach($objectsThatShouldBeNodeList as $key => $object) {
			$this->assertInstanceOf(
				NodeList::class,
				$object,
				"$key instance of " . gettype($object));
		}
	}

	public function testNodeListIndexOutOfBounds() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$paragraphList = $document->getElementsByTagName("p");
		$count = count($paragraphList);

		for($i = 0; $i < $count; $i++) {
			self::assertInstanceOf(
				Element::class,
				$paragraphList[$i]
			);
		}

		self::assertNull($paragraphList[$count]);
	}

	public function testCountDoesNotBreakIterator() {
		$document = new HTMLDocument(Helper::HTML_SECTIONS_WITHIN_FORM);
		$form = $document->getElementById("example-form");
		$sectionList = $form->querySelectorAll("section");
		$count = count($sectionList);
		$actualCount = 0;

		foreach($sectionList as $i => $section) {
			$actualCount ++;
			$section->setAttribute(
				"data-section-count",
				count($sectionList)
			);
		}

		self::assertGreaterThan(1, $actualCount);
		self::assertEquals($count, $actualCount);
	}
}