<?php
namespace Gt\Dom\Test;

use Gt\Dom\HTMLDocument;
use Gt\Dom\Test\Helper\Helper;
use Gt\Dom\TokenList;
use PHPUnit\Framework\TestCase;

class AttrTest extends TestCase {
	public function testAttrMove() {
		$document = new HTMLDocument(Helper::DOCS_ATTR_GETATTRIBUTENODE);
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