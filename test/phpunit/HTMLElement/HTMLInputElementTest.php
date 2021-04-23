<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\ClientSide\FileList;
use Gt\Dom\Exception\ClientSideOnlyFunctionalityException;
use Gt\Dom\Exception\FunctionalityNotAvailableOnServerException;
use Gt\Dom\HTMLElement\HTMLFormElement;
use Gt\Dom\HTMLElement\HTMLInputElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLInputElementTest extends HTMLElementTestCase {
	public function testChecked():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::assertPropertyAttributeCorrelateBool($sut, "checked");
	}

	public function testDefaultChecked():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::assertPropertyAttributeCorrelateBool($sut, "checked", "defaultChecked");
	}

	public function testIndeterminateGet():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::expectException(FunctionalityNotAvailableOnServerException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$value = $sut->indeterminate;
	}

	public function testIndeterminateSet():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::expectException(FunctionalityNotAvailableOnServerException::class);
		$sut->indeterminate = true;
	}

	public function testAlt():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::assertPropertyAttributeCorrelate($sut, "alt");
	}

	public function testHeight():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::assertPropertyAttributeCorrelateNullableInt($sut, "height");
	}

	public function testSrc():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::assertPropertyAttributeCorrelate($sut, "src");
	}

	public function testWidth():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::assertPropertyAttributeCorrelateNullableInt($sut, "width");
	}

	public function testAccept():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::assertPropertyAttributeCorrelate($sut, "accept");
	}

	public function testFilesGet():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$value = $sut->files;
	}

	public function testFilesSet():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		$files = self::createMock(FileList::class);
		$sut->files = $files;
	}

	public function testFormActionDefault():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::assertPropertyAttributeCorrelate($sut, "formaction", "formAction");
	}

	public function testFormActionWithinForm():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		/** @var HTMLFormElement $form */
		$form = $sut->ownerDocument->createElement("form");
		$form->action = "/example";
		$form->appendChild($sut);
		self::assertEquals("/example", $sut->formAction);
	}

	public function testFormEncTypeDefault():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::assertPropertyAttributeCorrelate($sut, "formenctype", "formEncType");
	}

	public function testFormEncTypeWithinForm():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		/** @var HTMLFormElement $form */
		$form = $sut->ownerDocument->createElement("form");
		$form->enctype = "test/example";
		$form->appendChild($sut);
		self::assertEquals("test/example", $sut->formEncType);
	}
}
