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
}
