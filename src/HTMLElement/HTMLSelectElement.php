<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\HTMLCollection;

/**
 * The HTMLSelectElement interface represents a <select> HTML Element. These
 * elements also share all of the properties and methods of other HTML elements
 * via the HTMLElement interface.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement
 *
 * @property-read int $length An unsigned long The number of <option> elements in this select element.
 * @property bool $multiple A Boolean reflecting the multiple HTML attribute, which indicates whether multiple items can be selected.
 * @property-read HTMLOptionsCollection $options An HTMLOptionsCollection representing the set of <option> (HTMLOptionElement) elements contained by this element.
 * @property int $selectedIndex A long reflecting the index of the first selected <option> element. The value -1 indicates no element is selected.
 * @property-read HTMLCollection $selectedOptions An HTMLCollection representing the set of <option> elements that are selected.
 * @property int $size A long reflecting the size HTML attribute, which contains the number of visible items in the control. The default is 1, unless multiple is true, in which case it is 4.
 */
class HTMLSelectElement extends HTMLElement {
	use HTMLUIElement;

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/length */
	protected function __prop_get_length():int {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/multiple */
	protected function __prop_get_multiple():bool {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/multiple */
	protected function __prop_set_multiple(bool $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/options */
	protected function __prop_get_options():HTMLOptionsCollection {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/selectedIndex */
	protected function __prop_get_selectedIndex():int {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/selectedIndex */
	protected function __prop_set_selectedIndex(int $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/selectedOptions */
	protected function __prop_get_selectedOptions():HTMLCollection {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/size */
	protected function __prop_get_size():int {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/size */
	protected function __prop_set_size(int $value):void {

	}
}
