<?php
namespace Gt\Dom;

use DOMXPath;
use Symfony\Component\CssSelector\CssSelectorConverter;

/**
 * Contains methods that are particular to Node objects that can have children.
 *
 * This trait can only be used in a class that is a trait of LiveProperty.
 *
 * This trait is used by the following classes:
 *  - Element
 *  - Document and its subclasses XMLDocument and HTMLDocument
 *  - DocumentFragment
 * @property-read HTMLCollection $children A live HTMLCollection containing all
 *  objects of type Element that are children of this ParentNode.
 * @property-read Element|null $firstElementChild The Element that is the first
 *  child of this ParentNode.
 * @property-read Element|null $lastElementChild The Element that is the last
 *  child of this ParentNode.
 * @property-read int $childElementCount The amount of children that the
 *  ParentNode has.
 *
 * @method Node getElementById(string $id)
 */
trait ParentNode {
	/** @return Element|null */
	public function querySelector(string $selector) {
		$htmlCollection = $this->css($selector);

		return $htmlCollection->item(0);
	}

	public function querySelectorAll(string $selector):HTMLCollection {
		return $this->css($selector);
	}

	private function prop_get_children():HTMLCollection {
		return new HTMLCollection($this->childNodes);
	}

	private function prop_get_firstElementChild() {
		return $this->children->item(0);
	}

	private function prop_get_lastElementChild() {
		return $this->children->item($this->children->length - 1);
	}

	private function prop_get_childElementCount() {
		return $this->children->length;
	}

	/**
	 * @param string $selectors CSS selector(s)
	 * @param string $prefix
	 *
	 * @return HTMLCollection
	 */
	public function css(
		string $selectors,
		string $prefix = "descendant-or-self::"
	):HTMLCollection {
		$converter = new CssSelectorConverter();
		$xPathSelector = $converter->toXPath($selectors, $prefix);

		return $this->xPath($xPathSelector);
	}

	public function xPath(string $selector):HTMLCollection {
		$x = new DOMXPath($this->getRootDocument());

		return new HTMLCollection($x->query($selector, $this));
	}

	public function getElementsByTagName($name) {
		$nodeList = parent::getElementsByTagName($name);
		if($nodeList instanceof NodeList) {
			return $nodeList;
		}

		return new NodeList($nodeList);
	}

	/**
	 * Normalises access to the parent dom document, which may be located in various places
	 * depending on what type of object is using the trait
	 *
	 * @return \DOMDocument
	 */
	protected abstract function getRootDocument():\DOMDocument;
}