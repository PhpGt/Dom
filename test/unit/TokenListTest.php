<?php
namespace Gt\Dom\Test;

use Gt\Dom\HTMLDocument;
use Gt\Dom\Test\Helper\Helper;
use Gt\Dom\TokenList;
use PHPUnit\Framework\TestCase;

class TokenListTest extends TestCase {
	public function testLength() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$h2 = $document->getElementById("who");
		$this->assertEquals(0, $document->body->classList->length);
		$this->assertEquals(3, $h2->classList->length);
	}

	public function testItem() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$h2 = $document->getElementById("who");
		$tokenList = new TokenList($h2, "class");
		$this->assertEquals("h-who", $tokenList->item(0));
		$this->assertEquals("m-test", $tokenList->item(2));
	}

	public function testContains() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$h2 = $document->getElementById("who");
		$this->assertTrue($h2->classList->contains("m-before-p"));
		$this->assertFalse($h2->classList->contains("nothing"));
		$this->assertFalse($h2->classList->contains(""));
		$this->assertFalse($h2->classList->contains("c1"));
	}

	public function testAdd() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$h2 = $document->getElementById("who");
		$classString = "h-who m-before-p m-test";
		$this->assertEquals($classString, $h2->getAttribute("class"));

		$h2->classList->add("added-here");
		$this->assertEquals("$classString added-here", $h2->getAttribute("class"));
// adding the same token should not add twice.
		$h2->classList->add("added-here");
		$this->assertEquals("$classString added-here", $h2->getAttribute("class"));
	}

	public function testRemove() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$h2 = $document->getElementById("who");
		$classString = "h-who m-before-p m-test";
		$this->assertEquals($classString, $h2->getAttribute("class"));

		$h2->classList->remove("m-before-p");
		$classString = str_replace("m-before-p ", "", $classString);
		$this->assertEquals($classString, $h2->getAttribute("class"));

		$h2->classList->remove("m-before-p");
		$this->assertEquals($classString, $h2->getAttribute("class"));

		$h2->classList->remove("does-not-exist");
		$this->assertEquals($classString, $h2->getAttribute("class"));
	}

	public function testToggle() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$h2 = $document->getElementById("who");
		$classString = "h-who m-before-p m-test";
		$this->assertEquals($classString, $h2->getAttribute("class"));

		$classStringNoBefore = str_replace("m-before-p ", "", $classString);
		$h2->classList->toggle("m-before-p");
		$this->assertEquals($classStringNoBefore, $h2->getAttribute("class"));

		$h2->classList->toggle("m-before-p");
		$this->assertEquals("$classStringNoBefore m-before-p",
			$h2->getAttribute("class"));

	}

	public function testCaseSensitivity() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$input = $document->querySelector("form .c1.c2.c3.c4");
		$this->assertTrue($input->classList->contains("c1"));
		$this->assertTrue(!$input->classList->contains("C1"));
		$input->classList->add("C1");
		$this->assertTrue($input->classList->contains("c1"));
		$this->assertTrue($input->classList->contains("C1"));
	}
}