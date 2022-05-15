<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\Exception\ArrayAccessReadOnlyException;
use Gt\Dom\HTMLElement\HTMLFormElement;
use Gt\Dom\HTMLElement\HTMLInputElement;
use Gt\Dom\HTMLElement\HTMLTextAreaElement;
use Gt\Dom\HTMLFormControlsCollection;
use Gt\Dom\RadioNodeList;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLFormElementTest extends HTMLElementTestCase {
//	public function testElementsEmpty():void {
//		/** @var HTMLFormElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("form");
//		$elements = $sut->elements;
//		self::assertInstanceOf(HTMLFormControlsCollection::class, $elements);
//		self::assertCount(0, $elements);
//	}
//
//	public function testElements():void {
//		/** @var HTMLFormElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("form");
//		$elements = $sut->elements;
//		$button = $sut->ownerDocument->createElement("button");
//		$input = $sut->ownerDocument->createElement("input");
//		$div = $sut->ownerDocument->createElement("div");
//		$select = $sut->ownerDocument->createElement("select");
//		$sut->append($button, $input, $div, $select);
//		self::assertCount(3, $elements);
//	}
//
//	public function testLengthEmpty():void {
//		/** @var HTMLFormElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("form");
//		self::assertEquals(0, $sut->length);
//		self::assertCount(0, $sut);
//	}
//
//	public function testName():void {
//		/** @var HTMLFormElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("form");
//		self::assertPropertyAttributeCorrelate($sut, "name");
//	}
//
//	public function testMethod():void {
//		/** @var HTMLFormElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("form");
//		self::assertPropertyAttributeCorrelate($sut, "method");
//	}
//
//	public function testTarget():void {
//		/** @var HTMLFormElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("form");
//		self::assertPropertyAttributeCorrelate($sut, "target");
//	}
//
//	public function testAction():void {
//		/** @var HTMLFormElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("form");
//		self::assertPropertyAttributeCorrelate($sut, "action");
//	}
//
//	public function testEncoding():void {
//		/** @var HTMLFormElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("form");
//		self::assertPropertyAttributeCorrelate($sut, "enctype", "encoding");
//		$sut->enctype = "";
//		self::assertPropertyAttributeCorrelate($sut, "enctype");
//	}
//
//	public function testEncodingEnctypeCorrelate():void {
//		/** @var HTMLFormElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("form");
//		$sut->setAttribute("enctype", "test-encoding");
//		self::assertEquals("test-encoding", $sut->encoding);
//	}
//
//	public function testAcceptCharset():void {
//		/** @var HTMLFormElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("form");
//		self::assertPropertyAttributeCorrelate($sut, "accept-charset", "acceptCharset");
//	}
//
//	public function testAutocomplete():void {
//		/** @var HTMLFormElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("form");
//		self::assertPropertyAttributeCorrelate($sut, "autocomplete");
//	}
//
//	public function testNoValidate():void {
//		/** @var HTMLFormElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("form");
//		self::assertPropertyAttributeCorrelateBool($sut, "novalidate", "noValidate");
//	}
//
//	public function testArrayAccess():void {
//		/** @var HTMLFormElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("form");
//		self::assertFalse(isset($sut["nothing"]));
//
//		/** @var HTMLInputElement $input */
//		$input = $sut->ownerDocument->createElement("input");
//		$input->name = "example";
//		/** @var HTMLTextAreaElement $textarea */
//		$textarea = $sut->ownerDocument->createElement("textarea");
//		$textarea->name = "another-example";
//		$sut->append($input, $textarea);
//		self::assertSame($textarea, $sut["another-example"]);
//	}
//
//	public function testArrayAccessSet():void {
//		/** @var HTMLFormElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("form");
//		self::expectException(ArrayAccessReadOnlyException::class);
//		$sut["nothing"] = "something";
//	}
//
//	public function testArrayAccessUnset():void {
//		/** @var HTMLFormElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("form");
//		self::expectException(ArrayAccessReadOnlyException::class);
//		unset($sut["nothing"]);
//	}
}
