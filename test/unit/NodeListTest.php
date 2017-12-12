<?php
namespace Gt\Dom;

use PHPUnit\Framework\TestCase;

class NodeListTest extends TestCase {
	public function testNodeListFunctionsReturnGtObjects() {
		$objectsThatShouldBeNodeList = [];
		$document = new HTMLDocument(test\Helper::HTML_MORE);

		$objectsThatShouldBeNodeList["tag-name"] = $document->getElementsByTagName("p");

		foreach($objectsThatShouldBeNodeList as $key => $object) {
			$this->assertInstanceOf(
				NodeList::class,
				$object,
				"$key instance of " . gettype($object));
		}
	}
}