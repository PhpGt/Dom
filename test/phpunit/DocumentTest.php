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
		$expected = "";
		if(PHP_MAJOR_VERSION >= 8) {
			// To catch v8-specific EOL.
			$expected .= PHP_EOL;
		}
		self::assertEquals($expected, (string)$sut);
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
		// Single EOL character in v8 onwards.
		self::assertEquals(PHP_MAJOR_VERSION >= 8 ? 1 : 0, $sut->getSize());
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
		$sut->saveHTML();
		$tell = $sut->tell();
		self::assertGreaterThan(1, $tell);
	}

	public function testFeof() {
		$sut = new Document();
		$sut->loadHTML($this->testHTML);
		self::assertFalse($sut->eof());
	}

	public function testIsSeekable() {
		$sut = new Document();
		self::assertTrue($sut->isSeekable());
	}

	public function testIsWritable() {
		$sut = new Document();
		self::assertTrue($sut->isWritable());
	}

	public function testReadable() {
		$sut = new Document();
		self::assertTrue($sut->isReadable());
	}

	public function testSeekError() {
		$sut = new Document();
		self::expectException(RuntimeException::class);
		self::expectExceptionMessage("Error seeking Document Stream");
		$sut->seek(PHP_INT_MAX);
	}

	public function testSeek() {
		$sut = new Document();
		$sut->loadHTML($this->testHTML);
		$sut->seek(12);
		$stream = $sut->detach();
		self::assertEquals(12, ftell($stream));
	}

	public function testRewind() {
		$sut = new Document();
		$sut->loadHTML($this->testHTML);
		$sut->seek(12);
		$sut->rewind();
		$stream = $sut->detach();
		self::assertEquals(0, ftell($stream));
	}

	public function testWrite() {
		$testString = "This is a test";

		$sut = new Document();
		$bytesWritten = $sut->write($testString);
		self::assertEquals(strlen($testString), $bytesWritten);

		$html = $sut->saveHTML();
		self::assertStringContainsString($testString, $html);
	}

	public function testRead() {
		$sut = new Document();
		$sut->loadHTML($this->testHTML);
		$readBytes = $sut->read(1024);
		self::assertStringContainsString($this->testHTML, $readBytes);
	}

	public function testGetMetadataSingleKey() {
		$sut = new Document();
		$mode = $sut->getMetadata("mode");
		self::assertIsString($mode);
	}

	public function testGetMetadataMissingKey() {
		$sut = new Document();
		$missing = $sut->getMetadata("missing");
		self::assertNull($missing);
	}

	public function testGetMetadata() {
		$sut = new Document();
		$array = $sut->getMetadata();
		self::assertIsArray($array);
	}
}
