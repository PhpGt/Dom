<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLCanvasElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLCanvasElementTest extends HTMLElementTestCase {
	public function testHeightDefault():void {
		/** @var HTMLCanvasElement $sut */
		$sut = NodeTestFactory::createHTMLElement("canvas");
		self::assertEquals(HTMLCanvasElement::DEFAULT_HEIGHT, $sut->height);
	}

	public function testHeight():void {
		/** @var HTMLCanvasElement $sut */
		$sut = NodeTestFactory::createHTMLElement("canvas");
		$rand = rand(1, 5000);
		$sut->height = $rand;
		self::assertEquals($rand, $sut->height);
	}

	public function testWidthDefault():void {
		/** @var HTMLCanvasElement $sut */
		$sut = NodeTestFactory::createHTMLElement("canvas");
		self::assertEquals(HTMLCanvasElement::DEFAULT_WIDTH, $sut->width);
	}

	public function testWidth():void {
		/** @var HTMLCanvasElement $sut */
		$sut = NodeTestFactory::createHTMLElement("canvas");
		$rand = rand(1, 5000);
		$sut->width = $rand;
		self::assertEquals($rand, $sut->width);
	}
}
