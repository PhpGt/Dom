<?php
namespace Gt\Dom;

use ArrayAccess;
use Countable;
use DOMNamedNodeMap;
use Gt\Dom\Exception\DOMException;
use Gt\Dom\Facade\NodeClass\DOMNodeFacade;
use Gt\PropFunc\MagicProp;
use Iterator;

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
 * @implements ArrayAccess<int|string, Attr>
 * @implements Iterator<string, string>
 */
class NamedNodeMap implements ArrayAccess, Countable, Iterator {
	use MagicProp;

	/** @var callable Returns a DOMNamedNodeMap */
	private $callback;
	private int $iteratorIndex;

	/** @param callable $callback Returns a DOMNamedNodeMapFacade */
	protected function __construct(
		callable $callback,
		private Element $owner
	) {
		$this->callback = $callback;
		$this->iteratorIndex = 0;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/NamedNodeMap/length */
	protected function __prop_get_length():int {
		return $this->getNative()->length;
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
		$nativeAttr = $this->getNative()->getNamedItem(
			$qualifiedName
		);
		if(!$nativeAttr) {
			return null;
		}

		/** @var Attr $gtAttr */
		$gtAttr = $this->owner->ownerDocument->getGtDomNode($nativeAttr);
		return $gtAttr;
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
		$nativeAttr = $this->getNative()->getNamedItemNS(
			$namespace,
			$localName
		);
		if(!$nativeAttr) {
			return null;
		}

		/** @var Attr $gtAttr */
		$gtAttr = $this->owner->ownerDocument->getGtDomNode($nativeAttr);
		return $gtAttr;
	}

	/**
	 * Replaces, or adds, the Attr identified in the map by the given name.
	 *
	 * @param Attr $attr
	 * @return ?Attr The replaced Attr, or Null if provided Attr was new.
	 */
	public function setNamedItem(Attr $attr):?Attr {
		$existing = false;
		if($this->getNative()->getNamedItem($attr->name)) {
			$existing = true;
		}

		$this->owner->setAttribute($attr->name, $attr->value);

		if($existing) {
			return $attr;
		}
		return null;
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
		$nativeAttr = $this->owner->ownerDocument->getNativeDomNode($attr);

		$existing = false;
		if($this->getNative()->getNamedItemNS(
			$attr->namespaceURI,
			$attr->name)
		) {
			$existing = true;
		}

		$this->owner->setAttributeNS(
			$attr->namespaceURI,
			$attr->name,
			$attr->value
		);

		if($existing) {
			return $attr;
		}
		return null;
	}

	/**
	 * Removes the Attr identified by the given map.
	 *
	 * @param Attr $attr
	 * @return Attr The removed Attr
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/NamedNodeMap/removeNamedItem
	 */
	public function removeNamedItem(Attr $attr):Attr {
		$nativeAttr = $this->owner->ownerDocument->getNativeDomNode($attr);
		$this->getNative()->removeNamedItem($nativeAttr);
		return $attr;
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
		$nativeAttr = $this->owner->ownerDocument->getNativeDomNode($attr);
		$this->getNative()->removeNamedItemNS(
			$nativeAttr,
			$localName
		);
		return $attr;
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
		$nativeAttr = $this->getNative()->item($index);
		if(!$nativeAttr) {
			return null;
		}

		/** @var Attr $gtAttr */
		$gtAttr = $this->owner->ownerDocument->getGtDomNode($nativeAttr);
		return $gtAttr;
	}

	/**
	 * @param int|string $offset
	 * @noinspection PhpMissingParamTypeInspection
	 */
	public function offsetExists($offset):bool {
		if(is_int($offset)) {
			$item = $this->item($offset);
		}
		else {
			$item = $this->getNamedItem($offset);
		}

		return !is_null($item);
	}

	/**
	 * @param int|string $offset
	 * @noinspection PhpMissingParamTypeInspection
	 */
	public function offsetGet($offset):?Node {
		if(is_int($offset)) {
			return $this->item($offset);
		}
		else {
			return $this->getNamedItem($offset);
		}
	}

	/**
	 * @param mixed $offset
	 * @param mixed $value
	 * @noinspection PhpMissingParamTypeInspection
	 */
	public function offsetSet($offset, $value):void {
		throw new DOMException("Use setNamedItem instead of ArrayAccess");
	}

	/**
	 * @param mixed $offset
	 * @noinspection PhpMissingParamTypeInspection
	 */
	public function offsetUnset($offset):void {
		throw new DOMException("Use removeNamedItem instead of ArrayAccess");
	}

	public function count() {
		return $this->getNative()->length;
	}

	/** @return DOMNamedNodeMap<DOMNodeFacade> */
	private function getNative():DOMNamedNodeMap {
		/** @var DOMNamedNodeMap<DOMNodeFacade> $nativeNamedNodeMap */
		$nativeNamedNodeMap = call_user_func($this->callback);
		return $nativeNamedNodeMap;
	}

	public function current():string {
		return $this->item($this->iteratorIndex)->value;
	}

	public function next():void {
		$this->iteratorIndex++;
	}

	public function key():string {
		return $this->item($this->iteratorIndex)->name;
	}

	public function valid():bool {
		return $this->offsetExists($this->iteratorIndex);
	}

	public function rewind():void {
		$this->iteratorIndex = 0;
	}
}
