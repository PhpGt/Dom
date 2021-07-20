<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLProgressElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLProgressElementTest extends HTMLElementTestCase {
	public function testMax():void {
		/** @var HTMLProgressElement $sut */
		$sut = NodeTestFactory::createHTMLElement("progress");
		self::assertPropertyAttributeCorrelateNumber($sut, "?float", "max");
	}

	public function testPositionNoValueOrMax():void {
		/** @var HTMLProgressElement $sut */
		$sut = NodeTestFactory::createHTMLElement("progress");
		self::assertSame(-1.0, $sut->position);
	}

	public function testPositionNoMax():void {
		/** @var HTMLProgressElement $sut */
		$sut = NodeTestFactory::createHTMLElement("progress");
		for($i = 0; $i < 10; $i++) {
			$sut->value = rand(-999, 999);
			self::assertSame(-1.0, $sut->position);
		}
	}

	public function testPosition():void {
		/** @var HTMLProgressElement $sut */
		$sut = NodeTestFactory::createHTMLElement("progress");
		for($i = 0; $i < 10; $i++) {
			do {
				$sut->value = (string)rand(-999, 999);
			}
			while($sut->value > -0.1 && $sut->value < 0.1);

			do {
				$sut->max = rand(-999, 999);
			}
			while($sut->max > -0.1 && $sut->max < 0.1);

			$calc = $sut->value / $sut->max;
			if($calc > 1) {
				$calc = 1;
			}
			self::assertEquals($calc, $sut->position);
		}
	}

	public function testValue():void {
		/** @var HTMLProgressElement $sut */
		$sut = NodeTestFactory::createHTMLElement("progress");
		self::assertPropertyAttributeCorrelateNumber($sut, "?float", "value");
	}
}
