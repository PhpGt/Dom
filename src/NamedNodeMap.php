<?php
namespace Gt\Dom;

use Gt\PropFunc\MagicProp;

/**
 * The NamedNodeMap interface represents a collection of Attr objects. Objects
 * inside a NamedNodeMap are not in any particular order, unlike NodeList,
 * although they may be accessed by an index as in an array.
 *
 * A NamedNodeMap object is live and will thus be auto-updated if changes are
 * made to its contents internally or elsewhere.
 *
 * Although called NamedNodeMap, this interface doesn't deal with Node objects
 * but with Attr objects, which were originally a specialized class of Node,
 * and still are in some implementations.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/NamedNodeMap
 *
 * @property-read int $length Returns the amount of objects in the map.
 */
class NamedNodeMap {
	use MagicProp;

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/NamedNodeMap/length */
	protected function __prop_get_length():int {

	}

	/**
	 * The getNamedItem() method of the NamedNodeMap interface returns the
	 * Attr corresponding to the given name, or null if there is no
	 * corresponding attribute.
	 *
	 * @param string $qualifiedName name is the name of the desired attribute.
	 * @return ?Attr
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/NamedNodeMap/getNamedItem
	 */
	public function getNamedItem(string $qualifiedName):?Attr {

	}

	/**
	 * Returns a Attr identified by a namespace and related local name.
	 *
	 * @param string $namespace
	 * @param string $localName
	 * @return ?Attr
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/NamedNodeMap/getNamedItemNS
	 */
	public function getNamedItemNS(
		string $namespace,
		string $localName
	):?Attr {

	}

	/**
	 * Replaces, or adds, the Attr identified in the map by the given name.
	 *
	 * @param Attr $attr
	 * @return ?Attr The replaced Attr, or Null if provided Attr was new.
	 */
	public function setNamedItem(Attr $attr):?Attr {

	}

	/**
	 * Replaces, or adds, the Attr identified in the map by the given
	 * namespace and related local name.
	 *
	 * @param Attr $attr
	 * @return ?Attr The replaced Attr, or Null if provided Attr was new.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/NamedNodeMap/setNamedItemNS
	 */
	public function setNamedItemNS(Attr $attr):?Attr {

	}

	/**
	 * Removes the Attr identified by the given map.
	 *
	 * @param Attr $attr
	 * @return Attr The removed Attr
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/NamedNodeMap/removeNamedItem
	 */
	public function removeNamedItem(Attr $attr):Attr {

	}

	/**
	 * Removes the Attr identified by the given namespace and related local
	 * name.
	 *
	 * @param Attr $attr
	 * @param string $localName
	 * @return Attr The removed Attr
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/NamedNodeMap/removeNamedItem
	 */
	public function removeNamedItemNS(Attr $attr, string $localName):Attr {

	}

	/**
	 * Returns the Attr at the given index, or null if the index is higher
	 * or equal to the number of nodes.
	 *
	 * @param int $index
	 * @return ?Attr
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/NamedNodeMap/item
	 */
	public function item(int $index):?Attr {

	}
}
