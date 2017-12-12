<?php
namespace Gt\Dom;

use Gt\Dom\TokenList;

class AttrTest extends \PHPUnit_Framework_TestCase {

	public function testAttrMove() {
		$document = new HTMLDocument(test\Helper::DOCS_ATTR_GETATTRIBUTENODE);
		$arduinoElement = $document->getElementById("arduino");
		$raspberryPiElement = $document->getElementById("raspberry-pi");

		// Reference the attribute, remove it from its current parent, reattach it to new parent.
		$attribute = $raspberryPiElement->getAttributeNode("class");
		$raspberryPiElement->removeAttributeNode($attribute);
		$arduinoElement->setAttributeNode($attribute);

		$this->assertSame($attribute, $arduinoElement->getAttributeNode("class"));
		$this->assertFalse($raspberryPiElement->getAttributeNode("class"));
	}
}