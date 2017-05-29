<?php
namespace Gt\Dom;

class EmojiTest extends \PHPUnit_Framework_TestCase {

const EMOJI_ONCOMING_FIST = "👊";
const EMOJI_GRINNING_CAT_FACE = "😸";
const EMOJI_WHITE_STAR = "☆";

public function testCreation() {
	$document = new HTMLDocument(
		"<!doctype html>" . self::EMOJI_ONCOMING_FIST);
	$this->assertContains(
		self::EMOJI_ONCOMING_FIST,
		$document->textContent
	);
}

public function testGetSet() {
	$document = new HTMLDocument();
	$document->body->innerHTML = self::EMOJI_GRINNING_CAT_FACE;

	$this->assertContains(
		self::EMOJI_GRINNING_CAT_FACE,
		$document->body->textContent
	);

	$document = new HTMLDocument();
	$document->body->textContent = self::EMOJI_GRINNING_CAT_FACE;
	$this->assertContains(
		self::EMOJI_GRINNING_CAT_FACE,
		$document->body->innerHTML
	);
}

public function testNested() {
    $document = new HTMLDocument(test\Helper::HTML_MORE);
    $firstHeader = $document->querySelector("h1");
    $span = $document->createElement("span");
    $span->textContent = self::EMOJI_WHITE_STAR;
    $firstHeader->appendChild($span);

    $this->assertContains(self::EMOJI_WHITE_STAR, $firstHeader->textContent);
}
}#
