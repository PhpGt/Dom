<?php
namespace Gt\Dom\Test;

use Gt\Dom\Document;
use Gt\Dom\Exception\DocumentStreamIsClosedException;
use Gt\Dom\Exception\DocumentStreamNotWritableException;
use Gt\Dom\Exception\DocumentStreamSeekFailureException;
use PHPUnit\Framework\TestCase;

class DocumentStreamTest extends TestCase {
//	public function testDetachBeforeOpen():void {
//		$sut = new Document();
//		self::expectException(DocumentStreamIsClosedException::class);
//		$sut->detach();
//	}
//
//	public function testDetach():void {
//		$sut = new Document();
//		$sut->open();
//		$stream = $sut->detach();
//		self::assertIsResource($stream);
//	}
//
//	public function testDetachNonWritable():void {
//		$sut = new Document();
//		$sut->open();
//		$sut->detach();
//		self::expectException(DocumentStreamNotWritableException::class);
//		$sut->write("test");
//	}
//
//	public function testGetSize():void {
//		$sut = new Document();
//		$sut->open();
//		self::assertEquals(strlen("\n"), $sut->getSize());
//	}
//
//	public function testGetSizeAfterWriting():void {
//		$sut = new Document();
//		$sut->open();
//		$sut->appendChild($sut->ownerDocument->createElement("example"));
//		self::assertEquals(strlen("<example></example>\n"), $sut->getSize());
//	}
//
//	public function testTell():void {
//		$sut = new Document();
//		$sut->open();
//		self::assertEquals(0, $sut->tell());
//	}
//
//	public function testWritableBeforeOpen():void {
//		$sut = new Document();
//		self::assertFalse($sut->isWritable());
//	}
//
//	public function testWritable():void {
//		$sut = new Document();
//		$sut->open();
//		self::assertTrue($sut->isWritable());
//	}
//
//	public function testEof():void {
//		$sut = new Document();
//		$sut->open();
//		$sut->appendChild($sut->ownerDocument->createElement("example"));
//		$bytes = "";
//		while(!$sut->eof()) {
//			$bytes .= $sut->read(10);
//		}
//		self::assertEquals("<example></example>\n", $bytes);
//	}
//
//	public function testIsSeekableBeforeOpen():void {
//		$sut = new Document();
//		self::assertFalse($sut->isSeekable());
//	}
//
//	public function testIsSeekable():void {
//		$sut = new Document();
//		$sut->open();
//		self::assertTrue($sut->isSeekable());
//	}
//
//	public function testSeekBeforeOpen():void {
//		$sut = new Document();
//		self::expectException(DocumentStreamIsClosedException::class);
//		$sut->seek(1);
//	}
//
//	public function testSeek():void {
//		$sut = new Document();
//		$sut->appendChild($sut->ownerDocument->createElement("example"));
//		$sut->open();
//		$sut->seek(10);
//		self::assertEquals(10, $sut->tell());
//	}
//
//	public function testRewind():void {
//		$sut = new Document();
//		$sut->appendChild($sut->ownerDocument->createElement("example"));
//		$sut->open();
//		$sut->seek(10);
//		$sut->rewind();
//		self::assertEquals(0, $sut->tell());
//	}
//
//	public function testIsReadableBeforeOpen():void {
//		$sut = new Document();
//		self::assertFalse($sut->isReadable());
//	}
//
//	public function testIsReadable():void {
//		$sut = new Document();
//		$sut->open();
//		self::assertTrue($sut->isReadable());
//	}
//
//	public function testGetContentsBeforeOpen():void {
//		$sut = new Document();
//		self::expectException(DocumentStreamIsClosedException::class);
//		$sut->getContents();
//	}
//
//	public function testGetContents():void {
//		$sut = new Document();
//		$sut->appendChild($sut->ownerDocument->createElement("example"));
//		$sut->open();
//		$contents = $sut->getContents();
//		self::assertEquals("<example></example>\n", $contents);
//	}
//
//	public function testGetMetaData():void {
//		$sut = new Document();
//		$sut->open();
//		$meta = $sut->getMetadata();
//		self::assertArrayHasKey("timed_out", $meta);
//		self::assertArrayHasKey("blocked", $meta);
//		self::assertArrayHasKey("eof", $meta);
//		self::assertArrayHasKey("unread_bytes", $meta);
//		self::assertArrayHasKey("stream_type", $meta);
//		self::assertArrayHasKey("wrapper_type", $meta);
//		self::assertArrayHasKey("mode", $meta);
//		self::assertArrayHasKey("seekable", $meta);
//		self::assertArrayHasKey("uri", $meta);
//	}
}
