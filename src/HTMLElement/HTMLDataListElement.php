<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\HTMLCollection;

/**
 * The HTMLDataListElement interface provides special properties (beyond the
 * HTMLElement object interface it also has available to it by inheritance) to
 * manipulate <datalist> elements and their content.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLDataListElement
 *
 * @property-read HTMLCollection $options Is a HTMLCollection representing a collection of the contained option elements.
 */
class HTMLDataListElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLDataListElement/options */
	protected function __prop_get_options():HTMLCollection {

	}
}
