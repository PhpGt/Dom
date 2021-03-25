<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\ClientSide\MediaStream;
use Gt\Dom\Exception\ClientSideOnlyFunctionalityException;
use Gt\Dom\HTMLElement\HTMLVideoElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLVideoElementTest extends HTMLElementTestCase {
	public function testAudioTracks():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$track = $sut->audioTracks;
	}

	public function testTimeRanges():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$buffered = $sut->buffered;
	}

	public function testController():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::assertNull($sut->controller);
	}

	public function testError():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::assertNull($sut->error);
	}

	public function testTextTracks():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$tracks = $sut->textTracks;
	}

	public function testVideoTracks():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$tracks = $sut->videoTracks;
	}

	public function testAutoplay():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::assertPropertyAttributeCorrelateBool($sut, "autoplay");
	}

	public function testControls():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::assertPropertyAttributeCorrelateBool($sut, "controls");
	}

	public function testControlsList():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
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
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::assertPropertyAttributeCorrelate(
			$sut,
			"crossorigin",
			"crossOrigin"
		);
	}

	public function testCurrentSrc():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::assertEquals("", $sut->currentSrc);
	}

	public function testCurrentTime():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$t = $sut->currentTime;
	}

	public function testCurrentTimeSet():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		$sut->currentTime = 123;
	}

	public function testDefaultMuted():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::assertPropertyAttributeCorrelateBool(
			$sut,
			"muted",
			"defaultMuted"
		);
	}

	public function testDefaultPlaybackRate():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$r = $sut->defaultPlaybackRate;
	}

	public function testDefaultPlaybackRateSet():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		$sut->defaultPlaybackRate = 1.25;
	}

	public function testDisableRemotePlayback():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$b = $sut->disableRemotePlayback;
	}

	public function testDisableRemotePlaybackSet():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		$sut->disableRemotePlayback = true;
	}

	public function testDuration():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::assertNull($sut->duration);
	}

	public function testEnded():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::assertFalse($sut->ended);
	}

	public function testLoop():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::assertPropertyAttributeCorrelateBool($sut, "loop");
	}

	public function testMediaGroup():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::assertPropertyAttributeCorrelate(
			$sut,
			"mediagroup",
			"mediaGroup"
		);
	}

	public function testMuted():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$m = $sut->muted;
	}

	public function testMutedSet():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		$sut->muted = true;
	}

	public function testNetworkState():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::assertEquals(0, $sut->networkState);
	}

	public function testPaused():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$m = $sut->paused;
	}

	public function testPlaybackRate():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$r = $sut->playbackRate;
	}

	public function testPlaybackRateSet():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		$sut->playbackRate = 1.25;
	}

	public function testPlayed():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$p = $sut->played;
	}

	public function testPreload():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::assertPropertyAttributeCorrelate($sut, "preload");
	}

	public function testReadyState():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::assertEquals(0, $sut->readyState);
	}

	public function testSeekable():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$p = $sut->seekable;
	}

	public function testSeeking():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::assertFalse($sut->seeking);
	}

	public function testSinkId():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::assertEquals("", $sut->sinkId);
	}

	public function testSrc():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::assertPropertyAttributeCorrelate($sut, "src");
	}

	public function testSrcObject():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$s = $sut->srcObject;
	}

	public function testSrcObjectSet():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		$sut->srcObject = self::createMock(MediaStream::class);
	}

	public function testVolume():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$v = $sut->volume;
	}

	public function testVolumeSet():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		$sut->volume = 0.5;
	}

// Video-specific tests:
	public function testHeight():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::assertPropertyAttributeCorrelate($sut, "height");
	}

	public function testPoster():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::assertPropertyAttributeCorrelate($sut, "poster");
	}

	public function testVideoHeight():void {
		/** @var HTMLVideoElement $sut */
		$sut = NodeTestFactory::createHTMLElement("video");
		self::assertEquals(0, $sut->videoHeight);
	}
}
