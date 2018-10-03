<?php
namespace Gt\Dom\Test;

use PHPUnit\Framework\TestCase;
use Gt\Dom\HTMLDocument;
use Gt\Dom\Test\Helper\Helper;

class FormTest extends TestCase {
	public function testMultipleRadioCanNotBeCheckedViaProperty() {
		$document = new HTMLDocument(Helper::HTML_FORM_WITH_RADIOS);
		$whiteRadio = $document->querySelector("input[value=white]");
		$blackRadio = $document->querySelector("input[value=black]");

		$whiteRadio->checked = true;

		self::assertTrue(
			$whiteRadio->hasAttribute("checked"),
			"Checked attribute should be present on white radio after setting property on white."
		);
		self::assertFalse(
			$blackRadio->hasAttribute("checked"),
			"Checked attribute should not be present on black radio after setting property on white."
		);

		$blackRadio->checked = true;

		self::assertFalse(
			$whiteRadio->hasAttribute("checked"),
			"Checked attribute should not be present on white after setting property on black."
		);
		self::assertTrue(
			$blackRadio->hasAttribute("checked"),
			"Checked attribute should be present on black after setting property on black."
		);
	}
}