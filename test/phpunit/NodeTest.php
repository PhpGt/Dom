<?php
namespace Gt\Dom\Test;

use Error;
use Gt\Dom\Node;
use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase {
	public function testCanNotConstruct() {
		self::expectException(Error::class);
		self::expectExceptionMessage("Cannot instantiate abstract class Gt\Dom\Node");
		new Node();
	}
}
