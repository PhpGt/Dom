<?php
namespace Gt\Dom;

/**
 * The HTMLCollection interface represents a generic collection (array-like
 * object similar to arguments) of elements (in document order) and offers
 * methods and properties for selecting from the list.
 *
 * Note: This interface is called HTMLCollection for historical reasons (before
 * the modern DOM, collections implementing this interface could only have HTML
 * elements as their items).
 *
 * An HTMLCollection in the HTML DOM is live; it is automatically updated when
 * the underlying document is changed.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLCollection
 *
 * @property-read int $length Returns the number of items in the collection.
 */
class HTMLCollection {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLCollection/length */
	protected function __prop_get_length():int {

	}

	/**
	 * The HTMLCollection method item() returns the node located at the
	 * specified offset into the collection.
	 *
	 * @param int $index The position of the Node to be returned. Elements
	 * appear in an HTMLCollection in the same order in which they appear
	 * in the document's source.
	 * @return ?Node The Node at the specified index, or null if index is
	 * less than zero or greater than or equal to the length property.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLCollection/item
	 */
	public function item(int $index):?Node {

	}

	/**
	 * Returns the specific node whose ID or, as a fallback, name matches
	 * the string specified by name. Matching by name is only done as a last
	 * resort, only in HTML, and only if the referenced element supports the
	 * name attribute. Returns null if no node exists by the given name.
	 *
	 * An alternative to accessing collection[name] (which instead returns
	 * undefined when name does not exist). This is mostly useful for
	 * non-JavaScript DOM implementations.
	 *
	 * @param string $name
	 * @return ?Node
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLCollection/namedItem
	 */
	public function namedItem(string $name):?Node {

	}
}
