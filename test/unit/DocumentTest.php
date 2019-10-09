<?php
namespace Gt\Dom\Test;

use Gt\Dom\Document;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class DocumentTest extends TestCase {
	private $testHTML = <<<HTML
<h1>This is a test</h1>
<p>A very simple test</p>
HTML;

	public function testToStringEmpty() {
		$sut = new Document();
		self::assertEquals(PHP_EOL, $sut);
	}

	public function testToString() {
		$sut = new Document();
		$sut->loadHTML($this->testHTML);
		self::assertStringContainsString($this->testHTML, $sut);
	}

	public function testClose() {
		$sut = new Document();
		$sut->close();
		self::expectException(RuntimeException::class);
		self::expectExceptionMessage("Stream is closed");
		$sut->getContents();
	}

	public function testDetach() {
		$sut = new Document();
		$stream = $sut->detach();
		self::assertIsResource($stream);
		self::expectException(RuntimeException::class);
		self::expectExceptionMessage("Stream is not available");
		$sut->getContents();
	}

	public function testGetSizeEmpty() {
		$sut = new Document();
		self::assertEquals(1, $sut->getSize());
	}

	public function testGetSize() {
		$sut = new Document();
		$sut->loadHTML($this->testHTML);
		$size = $sut->getSize();
		$output = $sut->saveHTML();
		self::assertEquals(strlen($output), $sut->getSize());
	}

	public function testTell() {
		$sut = new Document();
		$sut->loadHTML($this->testHTML);
		self::assertEquals(0, $sut->tell());
		self::assertEquals(0, $sut->tell());
		$sut->saveHTML();
		self::assertGreaterThan(1, $sut->tell());
	}
}