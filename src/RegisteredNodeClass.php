<?php
namespace Gt\Dom;

use DOMNode;

/**
 * The DOMDocument inheritance model has some strange quirks in the
 * specification and PHP implementation.
 *
 * @property-read null|Node|Element $nextSibling Returns a Node representing the next node in the tree, or null if there isn't such node.
 * @property-read null|Node|Element $firstChild
 * @property-read null|Node|Element $lastChild
 * @property-read null|Node|Element $previousSibling Returns a Node representing the previous node in the tree, or null if there isn't such node.
 *
 * @method Node|Element cloneNode(bool $deep = false)
 */
trait RegisteredNodeClass {
	/**
	 * Returns a Boolean which indicates whether or not two nodes are of
	 * the same type and all their defining data points match.
	 *
	 * @param Node|Element|Document|DocumentType|Attr|ProcessingInstruction $otherNode
	 * The Node to compare equality with.
	 * @return bool
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Node/isEqualNode
	 */
	public function isEqualNode(Node|Element|Document|DocumentType|Attr|ProcessingInstruction|DOMNode $otherNode):bool {
		if($otherNode instanceof Document) {
			$otherNode = $otherNode->documentElement;
		}
		// For implementation specification, please see the W3C DOM Standard:
// @link https://dom.spec.whatwg.org/#concept-node-equals
		if($this->nodeType !== $otherNode->nodeType) {
			return false;
		}

		if($this->childNodes->length !== $otherNode->childNodes->length) {
			return false;
		}

		if($this instanceof DocumentType
		&& $otherNode instanceof DocumentType) {
			return $this->name === $otherNode->name
				&& $this->publicId === $otherNode->publicId
				&& $this->systemId === $otherNode->systemId;
		}

		if($this instanceof Element
			&& $otherNode instanceof Element) {
			$similar = $this->namespaceURI === $otherNode->namespaceURI
				&& $this->localName === $otherNode->localName
				&& $this->attributes->length === $otherNode->attributes->length;
			if(!$similar) {
				return false;
			}

			for($i = 0, $len = $this->attributes->length; $i < $len; $i++) {
				$attr = $this->attributes->item($i);
				$otherAttr = $otherNode->attributes->item($i);
				if(!$attr->isEqualNode($otherAttr)) {
					return false;
				}
			}

			for($i = 0, $len = $this->childNodes->length; $i < $len; $i++) {
				$child = $this->childNodes->item($i);
				$otherChild = $otherNode->childNodes->item($i);
				if(!$child->isEqualNode($otherChild)) {
					return false;
				}
			}

			return true;
		}

		if($this instanceof Attr
			&& $otherNode instanceof Attr) {
			return $this->namespaceURI === $otherNode->namespaceURI
				&& $this->localName === $otherNode->localName
				&& $this->value === $otherNode->value;
		}

		if($this instanceof ProcessingInstruction
		&& $otherNode instanceof ProcessingInstruction) {
			return $this->target === $otherNode->target
				&& $this->data === $otherNode->data;
		}

		if(isset($this->data)) {
			/** @var Text|Comment $this */
			/** @var Text|Comment $otherNode */
			return $this->data === $otherNode->data;
		}

		return false;
	}

	/**
	 * The getAttribute() method of the Element interface returns the value
	 * of a specified attribute on the element. If the given attribute does
	 * not exist, the value returned will be null.
	 *
	 * @param string $attributeName The name of the attribute whose value
	 * you want to get.
	 * @return ?string A string containing the value of attributeName.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/getAttribute
	 */
	public function getAttribute(string $qualifiedName):?string {
		if($this->hasAttribute($qualifiedName)) {
			return parent::getAttribute($qualifiedName);
		}

		return null;
	}

	/**
	 * The getAttributeNS() method of the Element interface returns the
	 * string value of the attribute with the specified namespace and name.
	 * If the named attribute does not exist, the value returned will be
	 * null.
	 *
	 * @param ?string $namespace The namespace in which to look for the
	 * specified attribute.
	 * @param string $name The name of the attribute to look for.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/getAttributeNS
	 */
	public function getAttributeNS(?string $namespace, string $name):?string {
		if(!$this->hasAttributeNS($namespace, $name)) {
			return null;
		}

		return parent::getAttributeNS(
			$namespace,
			$name
		);
	}

	/**
	 * The getAttributeNames() method of the Element interface returns the
	 * attribute names of the element as an Array of strings. If the element
	 * has no attributes it returns an empty array.
	 *
	 * Using getAttributeNames() along with getAttribute(), is a
	 * memory-efficient and performant alternative to accessing
	 * Element.attributes.
	 *
	 * @return array<string>
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/getAttributeNames
	 */
	public function getAttributeNames():array {
		$attributeArray = iterator_to_array($this->attributes);
		return array_keys($attributeArray);
	}

	/**
	 * The Element method getElementsByClassName() returns a live
	 * HTMLCollection which contains every descendant element which has the
	 * specified class name or names.
	 *
	 * The method getElementsByClassName() on the Document interface works
	 * essentially the same way, except it acts on the entire document,
	 * starting at the document root.
	 *
	 * @param string $names A DOMString containing one or more class names to match on, separated by whitespace.
	 * @return HTMLCollection An HTMLCollection providing a live-updating list of every element which is a member of every class in names.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/getElementsByClassName
	 */
	public function getElementsByClassName(string $names):HTMLCollection {
		$querySelector = "";
		foreach(explode(" ", $names) as $name) {
			if(strlen($querySelector) > 0) {
				$querySelector .= " ";
			}

			$querySelector .= ".$name";
		}

		return HTMLCollectionFactory::create(
			fn() => $this->querySelectorAll($querySelector)
		);
	}
}
