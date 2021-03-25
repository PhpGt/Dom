<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\Exception\ClientSideOnlyFunctionalityException;
use Gt\Dom\HTMLElement\HTMLAudioElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLAudioElementTest extends HTMLElementTestCase {
	public function testAudioTracks():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$track = $sut->audioTracks;
	}

	public function testTimeRanges():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$buffered = $sut->buffered;
	}

	public function testController():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::assertNull($sut->controller);
	}

	public function testError():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::assertNull($sut->error);
	}

	public function testTextTracks():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$tracks = $sut->textTracks;
	}
}
