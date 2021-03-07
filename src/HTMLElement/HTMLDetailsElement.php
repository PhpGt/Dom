<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLDetailsElement interface provides special properties (beyond the
 * regular HTMLElement interface it also has available to it by inheritance) for
 * manipulating <details> elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLDetailsElement
 *
 * @property bool $open Is a boolean reflecting the open HTML attribute, indicating whether or not the element’s contents (not counting the <summary>) is to be shown to the user.
 */
class HTMLDetailsElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLDetailsElement/open */
	protected function __prop_get_open():bool {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLDetailsElement/open */
	protected function __prop_set_open(bool $value):void {

	}
}
