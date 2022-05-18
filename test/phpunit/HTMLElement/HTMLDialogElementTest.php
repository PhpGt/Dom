<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\Exception\ClientSideOnlyFunctionalityException;
use Gt\Dom\HTMLDocument;

class HTMLDialogElementTest extends HTMLElementTestCase {
	public function testOpenDefault():void {
		$document = new HTMLDocument();
		$sut = $document->createElement("dialog");
		self::assertFalse($sut->open);
	}

	public function testOpen():void {
		$document = new HTMLDocument();
		$sut = $document->createElement("dialog");
		$sut->open = true;
		self::assertTrue($sut->open);
		self::assertTrue($sut->hasAttribute("open"));

		$sut->open = false;
		self::assertFalse($sut->open);
		self::assertFalse($sut->hasAttribute("open"));
	}

	public function testReturnValueGetter():void {
		$document = new HTMLDocument();
		$sut = $document->createElement("dialog");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$something = $sut->returnValue;
	}

	public function testReturnValueSetter():void {
		$document = new HTMLDocument();
		$sut = $document->createElement("dialog");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		$sut->returnValue = "something";
	}
}
