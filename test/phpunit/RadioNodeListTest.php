<?php
namespace Gt\Dom\Test;

use Gt\Dom\HTMLDocument;
use Gt\Dom\RadioNodeList;
use Gt\Dom\Test\TestFactory\DocumentTestFactory;
use PHPUnit\Framework\TestCase;

class RadioNodeListTest extends TestCase {
	public function testValue():void {
		$document = new HTMLDocument(DocumentTestFactory::HTML_RADIO_BUTTONS);
		$form = $document->forms[0];
		$radioNodeList = $form["bean"];
		self::assertInstanceOf(RadioNodeList::class, $radioNodeList);
		self::assertCount(5, $radioNodeList);
		$edamameInput = $document->querySelector("[name='bean'][value='edamame']");
		self::assertFalse($edamameInput->checked);
		$radioNodeList->value = "edamame";
		self::assertTrue($edamameInput->checked);
		self::assertSame("edamame", $radioNodeList->value);
	}
}
