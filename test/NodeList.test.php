<?php
namespace Gt\Dom;

class NodeListTest extends \PHPUnit_Framework_TestCase {

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