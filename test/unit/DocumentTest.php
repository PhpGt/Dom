<?php
namespace Gt\Dom\Test;

use Gt\Dom\Document;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class DocumentTest extends TestCase {
	public function testToStringEmpty() {
		$sut = new Document();
		self::assertEquals(PHP_EOL, $sut);
	}

	public function testToString() {
		$html = <<<HTML
<h1>This is a test</h1>
<p>A very simple test</p>
HTML;

		$sut = new Document();
		$sut->loadHTML($html);
		self::assertStringContainsString($html, $sut);
	}

	public function testClose() {
		$sut = new Document();
		$sut->close();
		self::expectException(RuntimeException::class);
		self::expectExceptionMessage("Stream is closed");
		$sut->getContents();
	}
}