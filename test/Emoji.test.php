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

}#
