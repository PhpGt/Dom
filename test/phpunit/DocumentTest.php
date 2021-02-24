<?php
namespace Gt\Dom\Test;

use Gt\Dom\Document;
use PHPUnit\Framework\TestCase;

class DocumentTest extends TestCase {
	public function testToStringEmpty():void {
		$sut = new Document();
		self::assertEquals(PHP_EOL, $sut);
	}
}
