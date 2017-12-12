<?php
namespace Gt\Dom\Test;

use Gt\Dom\HTMLDocument;
use Gt\Dom\Test\Helper\Helper;
use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase {
	public function testHasAttribute() {
		$document = new HTMLDocument(Helper::HTML);
		$this->assertFalse($document->body->hasAttribute("example"));
		$document->body->setAttribute("example", "exampleValue");
		$this->assertTrue($document->body->hasAttribute("example"));
	}
}