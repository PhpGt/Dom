<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLTextAreaElement interface provides special properties and methods for
 * manipulating the layout and presentation of <textarea> elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTextAreaElement
 *
 * @property string $autocapitalize Returns / Sets the element's capitalization behavior for user input. Valid values are: none, off, characters, words, sentences.
 * @property int $cols Returns / Sets the element's cols attribute, indicating the visible width of the text area.
 * @property string $defaultValue Returns / Sets the control's default value, which behaves like the Node.textContent property.
 * @property int $maxLength Returns / Sets the element's maxlength attribute, indicating the maximum number of characters the user can enter. This constraint is evaluated only when the value changes.
 * @property int $minLength Returns / Sets the element's minlength attribute, indicating the minimum number of characters the user can enter. This constraint is evaluated only when the value changes.
 * @property int $rows Returns / Sets the element's rows attribute, indicating the number of visible text lines for the control.
 * @property string $wrap Returns / Sets the wrap HTML attribute, indicating how the control wraps text.
 */
class HTMLTextAreaElement extends HTMLElement {
	use HTMLUIElement;

	protected function __prop_get_autocapitalize():string {

	}

	protected function __prop_set_autocapitalize(string $value):void {

	}

	protected function __prop_get_cols():int {

	}

	protected function __prop_set_cols(int $value):void {

	}

	protected function __prop_get_defaultValue():string {

	}

	protected function __prop_set_defaultValue(string $value):void {

	}

	protected function __prop_get_maxLength():int {

	}

	protected function __prop_set_maxLength(int $value):void {

	}

	protected function __prop_get_minLength():int {

	}

	protected function __prop_set_minLength(int $value):void {

	}

	protected function __prop_get_rows():int {

	}

	protected function __prop_set_rows(int $value):void {

	}

	protected function __prop_get_wrap():string {

	}

	protected function __prop_set_wrap(string $value):void {

	}
}
