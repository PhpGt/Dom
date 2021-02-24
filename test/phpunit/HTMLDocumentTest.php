<?php
namespace Gt\Dom\Test;

use Error;
use PHPUnit\Framework\TestCase;
use Gt\Dom\HTMLDocument;

class HTMLDocumentTest extends TestCase {
	public function testCanNotConstruct():void {
		self::expectException(Error::class);
		self::expectExceptionMessage("Call to protected Gt\Dom\HTMLDocument::__construct()");
		$className = HTMLDocument::class;
		/** @phpstan-ignore-next-line */
		new $className();
	}
}
