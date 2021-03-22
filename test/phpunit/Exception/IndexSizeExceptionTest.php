<?php
namespace Exception;

use Gt\Dom\Exception\IndexSizeException;
use Gt\PropFunc\PropertyReadOnlyException;
use PHPUnit\Framework\TestCase;

class IndexSizeExceptionTest extends TestCase {
	public function testNameProperty():void {
		$sut = new IndexSizeException();
		self::assertEquals("IndexSizeError", $sut->name);
	}

	public function testNameReadOnly():void {
		$sut = new IndexSizeException();
		self::expectException(PropertyReadOnlyException::class);
		$sut->name = "Can't change, but I'm trying to...";
	}
}
