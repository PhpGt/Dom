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

	public function testVideoTracks():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$tracks = $sut->videoTracks;
	}

	public function testAutoplay():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::assertPropertyAttributeCorrelateBool($sut, "autoplay");
	}

	public function testControls():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::assertPropertyAttributeCorrelateBool($sut, "controls");
	}

	public function testControlsList():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		$controlsList = $sut->controlsList;
		self::assertCount(0, $controlsList);
		$sut->setAttribute("controlsList", "one two three");
		self::assertCount(3, $controlsList);
		self::assertEquals("one", $controlsList->item(0));
		self::assertEquals("two", $controlsList->item(1));
		self::assertEquals("three", $controlsList->item(2));

		$sut->controlsList->add("four");
		self::assertCount(4, $sut->controlsList);
	}

	public function testCrossOrigin():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::assertPropertyAttributeCorrelate(
			$sut,
			"crossorigin",
			"crossOrigin"
		);
	}

	public function testCurrentSrc():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::assertEquals("", $sut->currentSrc);
	}

	public function testCurrentTime():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$t = $sut->currentTime;
	}

	public function testCurrentTimeSet():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		$sut->currentTime = 123;
	}

	public function testDefaultMuted():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::assertPropertyAttributeCorrelateBool(
			$sut,
			"muted",
			"defaultMuted"
		);
	}

	public function testDefaultPlaybackRate():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$r = $sut->defaultPlaybackRate;
	}

	public function testDefaultPlaybackRateSet():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		$sut->defaultPlaybackRate = 1.25;
	}

	public function testDisableRemotePlayback():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$b = $sut->disableRemotePlayback;
	}

	public function testDisableRemotePlaybackSet():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		$sut->disableRemotePlayback = true;
	}

	public function testDuration():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::assertNull($sut->duration);
	}

	public function testEnded():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::assertFalse($sut->ended);
	}

	public function testLoop():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::assertPropertyAttributeCorrelateBool($sut, "loop");
	}

	public function testMediaGroup():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::assertPropertyAttributeCorrelate(
			$sut,
			"mediagroup",
			"mediaGroup"
		);
	}

	public function testMuted():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$m = $sut->muted;
	}

	public function testMutedSet():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		$sut->muted = true;
	}

	public function testNetworkState():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::assertEquals(0, $sut->networkState);
	}

	public function testPaused():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$m = $sut->paused;
	}

	public function testPlaybackRate():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$r = $sut->playbackRate;
	}

	public function testPlaybackRateSet():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		$sut->playbackRate = 1.25;
	}

	public function testPlayed():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$p = $sut->played;
	}

	public function testPreload():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::assertPropertyAttributeCorrelate($sut, "preload");
	}

	public function testReadyState():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::assertEquals(0, $sut->readyState);
	}

	public function testSeekable():void {
		/** @var HTMLAudioElement $sut */
		$sut = NodeTestFactory::createHTMLElement("audio");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$p = $sut->seekable;
	}
}
