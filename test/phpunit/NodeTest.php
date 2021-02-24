<?php
namespace Gt\Dom\Test;

use Error;
use Gt\Dom\Node;
use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase {
	public function testPrivateConstructor() {
		self::expectException(Error::class);
		self::expectExceptionMessage("Call to protected Gt\Dom\Node::__construct()");
		$sut = new Node();
	}


}
