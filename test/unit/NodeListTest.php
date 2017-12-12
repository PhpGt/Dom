<?php
namespace Gt\Dom\Test;

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
}