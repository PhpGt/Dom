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

	public function testIfRadioChangesToUncheckedWhenSettingCheckedToFalse() {
        $document = new HTMLDocument(Helper::HTML_FORM_WITH_RADIOS);
        $whiteRadio = $document->querySelector("input[value=white]");

        $whiteRadio->checked = true;

        self::assertTrue(
            $whiteRadio->hasAttribute("checked"),
            "Checked attribute should be present on white radio after setting property on white."
        );

        $whiteRadio->checked = false;

        self::assertFalse($whiteRadio->hasAttribute("checked"),
            "Checked attribute should not be present on white radio after unsetting property on white.");
    }

	public function testMultipleSelectOptionCanNotBeCheckedViaProperty() {
		$document = new HTMLDocument(Helper::HTML_FORM_WITH_RADIOS);
		$under18option = $document->querySelector("option[value='0-17']");
		$youngAdultOption = $document->querySelector("option[value='18-35']");

		$under18option->selected = true;

		self::assertTrue($under18option->hasAttribute("selected"));
		self::assertFalse($youngAdultOption->hasAttribute("selected"));

		$youngAdultOption->selected = true;

		self::assertFalse($under18option->hasAttribute("selected"));
		self::assertTrue($youngAdultOption->hasAttribute("selected"));
	}

	public function testIfSelectOptionChangesToUnselectedWhenSettingSelectedToFalse() {
        $document = new HTMLDocument(Helper::HTML_FORM_WITH_RADIOS);
        $under18option = $document->querySelector("option[value='0-17']");

        $under18option->selected = true;

        self::assertTrue($under18option->hasAttribute("selected"));

        $under18option->selected = false;

        self::assertFalse($under18option->hasAttribute("selected"));

    }

	public function testMultipleSelectOptionCanBeCheckedViaPropertyWhenSelectMultiple() {
		$document = new HTMLDocument(Helper::HTML_FORM_WITH_RADIOS);
		$phpOption = $document->querySelector("option[value='php']");
		$haskellOption = $document->querySelector("option[value='haskell']");

		$phpOption->selected = true;
		$haskellOption->selected = true;

		self::assertTrue($phpOption->selected);
		self::assertTrue($haskellOption->selected);
	}
}