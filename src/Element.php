<?php
namespace Gt\Dom;

use DateTime;
use DOMAttr;
use DOMDocument;
use DOMElement;
use Gt\Dom\Facade\DOMTokenListFactory;
use Gt\Dom\Facade\NamedNodeMapFactory;
use Gt\Dom\Facade\NodeClass\DOMElementFacade;

/**
 * Element is the most general base class from which all element objects (i.e.
 * objects that represent elements) in a Document inherit. It only has methods
 * and properties common to all kinds of elements. More specific classes inherit
 * from Element. For example, the HTMLElement interface is the base interface
 * for HTML elements, while the SVGElement interface is the basis for all SVG
 * elements. Most functionality is specified further down the class hierarchy.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element
 *
 * @property-read NamedNodeMap<Attr> $attributes Returns a NamedNodeMap object containing the assigned attributes of the corresponding HTML element.
 * @property-read DOMTokenList $classList Returns a DOMTokenList containing the list of class attributes.
 * @property string $className Is a DOMString representing the class of the element.
 * @property string $id Is a DOMString representing the id of the element.
 * @property string $innerHTML Is a DOMString representing the markup of the element's content.
 * @property-read string $localName A DOMString representing the local part of the qualified name of the element.
 * @property-read ?string $namespaceURI The namespace URI of the element, or null if it is no namespace.
 * @property string $outerHTML Is a DOMString representing the markup of the element including its content. When used as a setter, replaces the element with nodes parsed from the given string.
 * @property-read string $prefix A DOMString representing the namespace prefix of the element, or null if no prefix is specified.
 * @property-read string $tagName Returns a String with the name of the tag for the given element.
 */
class Element extends Node {
	use NonDocumentTypeChildNode;
	use ChildNode;
	use ParentNode;

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/attributes */
	protected function __prop_get_attributes():NamedNodeMap {
		return NamedNodeMapFactory::create(
			fn() => $this->domNode->attributes,
			$this
		);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/classList */
	protected function __prop_get_classList():DOMTokenList {
		return DOMTokenListFactory::create(
			fn() => explode(" ", $this->className)
		);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/className */
	protected function __prop_get_className():string {
		return $this->getAttribute("class") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/className */
	protected function __prop_set_className(string $className):void {
		$domElement = $this->getNativeElement();
		$domElement->setAttribute("class", $className);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/id */
	protected function __prop_get_id():string {
		$nativeElement = $this->getNativeElement();
		return $nativeElement->getAttribute("id");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/id */
	protected function __prop_set_id(string $id):void {
		$element = $this->getNativeElement();
		$element->setAttribute("id", $id);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/innerHTML */
	protected function __prop_get_innerHTML():string {
		$html = "";

		/** @var DOMDocument $nativeDocument */
		$nativeDocument = $this->ownerDocument->domNode;

		foreach($this->childNodes as $child) {
			$nativeChild = $this->ownerDocument->getNativeDomNode($child);
			$html .= $nativeDocument->saveHTML($nativeChild);
		}

		return $html;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/innerHTML */
	protected function __prop_set_innerHTML(string $innerHTML):void {
		while($child = $this->firstChild) {
			/** @var Element $child */
			$child->parentNode->removeChild($child);
		}

		$tempDocument = new Document();
		/** @var DOMDocument $nativeTempDocument */
		$nativeTempDocument = $tempDocument->domNode;
		$nativeTempDocument->loadHTML(
			"<html-fragment>$innerHTML</html-fragment>"
		);
		$innerFragmentNode = $nativeTempDocument->getElementsByTagName(
			"html-fragment")->item(0);

		/** @var DOMDocument $nativeDocument */
		$nativeDocument = $this->ownerDocument->domNode;
		$imported = $nativeDocument->importNode(
			$innerFragmentNode,
			true
		);

		$nativeDomNode = $this->ownerDocument->getNativeDomNode($this);
		while($imported->firstChild) {
			$nativeDomNode->appendChild($imported->firstChild);
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/localName */
	protected function __prop_get_localName():string {
		return $this->domNode->localName;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/namespaceURI */
	protected function __prop_get_namespaceURI():?string {
		if(isset($this->domNode->namespaceURI)) {
			return $this->domNode->namespaceURI;
		}

		return null;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/outerHTML */
	protected function __prop_get_outerHTML():string {
		/** @var DOMDocument $nativeDocument */
		$nativeDocument = $this->ownerDocument->domNode;
		return $nativeDocument->saveHTML($this->domNode);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/outerHTML */
	protected function __prop_set_outerHTML(string $outerHTML):void {
		if(!$this->parentNode) {
			return;
		}

		$tempDocument = new Document();
		/** @var DOMDocument $nativeTempDocument */
		$nativeTempDocument = $tempDocument->domNode;
		$nativeTempDocument->loadHTML($outerHTML);
		$body = $nativeTempDocument->getElementsByTagName("body")->item(0);
		/** @var DOMDocument $nativeThisDocument */
		$nativeThisDocument = $this->ownerDocument->domNode;
		$nativeNextSibling = $this->domNode->nextSibling;
		$nativeParent = $this->domNode->parentNode;

		$nativeParent->removeChild($this->domNode);
		for($i = 0, $len = $body->childNodes->length; $i < $len; $i++) {
			$imported = $nativeThisDocument->importNode(
				$body->childNodes->item($i),
				true
			);
			$nativeParent->insertBefore(
				$imported,
				$nativeNextSibling
			);
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/prefix */
	protected function __prop_get_prefix():string {
		return $this->domNode->prefix;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/tagName */
	protected function __prop_get_tagName():string {
		return strtoupper($this->domNode->localName);
	}

	/**
	 * The closest() method traverses the Element and its parents (heading
	 * toward the document root) until it finds a node that matches the
	 * provided selector string. Will return itself or the matching
	 * ancestor. If no such element exists, it returns null.
	 *
	 * @param string $selectors a DOMString containing a selector list.
	 * ex: p:hover, .toto + q
	 * @return ?Element The Element which is the closest ancestor of the
	 * selected element. It may be null.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/closest
	 */
	public function closest(string $selectors):?Element {
		$matchesArray = iterator_to_array(
			$this->ownerDocument->querySelectorAll($selectors)
		);
		$context = $this;

		do {
			if(in_array($context, $matchesArray, true)) {
				return $context;
			}
		}
		while($context = $context->parentElement);

		return null;
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
	public function getAttribute(string $attributeName):?string {
		$nativeElement = $this->getNativeElement();
		if(!$nativeElement->hasAttribute($attributeName)) {
			return null;
		}

		return $nativeElement->getAttribute($attributeName);
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
	 * @return string[]
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/getAttributeNames
	 */
	public function getAttributeNames():array {
		$attributeArray = iterator_to_array($this->attributes);
		return array_keys($attributeArray);
	}

	/**
	 * The getAttributeNS() method of the Element interface returns the
	 * string value of the attribute with the specified namespace and name.
	 * If the named attribute does not exist, the value returned will be
	 * null.
	 *
	 * @param string $namespace The namespace in which to look for the
	 * specified attribute.
	 * @param string $name The name of the attribute to look for.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/getAttributeNS
	 */
	public function getAttributeNS(string $namespace, string $name):?string {
		if(!
		$this->hasAttributeNS($namespace, $name)) {
			return null;
		}

		return $this->getNativeElement()->getAttributeNS(
			$namespace,
			$name
		);
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

	}

	/**
	 * The Element.getElementsByTagName() method returns a live
	 * HTMLCollection of elements with the given tag name. All descendants
	 * of the specified element are searched, but not the element itself.
	 * The returned list is live, which means it updates itself with the
	 * DOM tree automatically. Therefore, there is no need to call
	 * Element.getElementsByTagName() with the same element and arguments
	 * repeatedly if the DOM changes in between calls.
	 *
	 * When called on an HTML element in an HTML document,
	 * getElementsByTagName lower-cases the argument before searching for
	 * it. This is undesirable when trying to match camel-cased SVG
	 * elements (such as <linearGradient>) in an HTML document. Instead,
	 * use Element.getElementsByTagNameNS(), which preserves the
	 * capitalization of the tag name.
	 *
	 * Element.getElementsByTagName is similar to
	 * Document.getElementsByTagName(), except that it only searches for
	 * elements that are descendants of the specified element.
	 *
	 * @param string $tagName the qualified name to look for. The special
	 * string "*" represents all elements. For compatibility with XHTML,
	 * lower-case should be used.
	 * @return HTMLCollection a live HTMLCollection of elements with a
	 * matching tag name, in the order they appear. If no elements are
	 * found, the HTMLCollection is empty.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/getElementsByTagName
	 */
	public function getElementsByTagName(string $tagName):HTMLCollection {

	}

	/**
	 * The Element.getElementsByTagNameNS() method returns a live
	 * HTMLCollection of elements with the given tag name belonging to the
	 * given namespace. It is similar to Document.getElementsByTagNameNS,
	 * except that its search is restricted to descendants of the specified
	 * element.
	 *
	 * @param string $namespaceURI the namespace URI of elements to look for
	 * (see Element.namespaceURI and Attr.namespaceURI). For example, if you
	 * need to look for XHTML elements, use the XHTML namespace URI,
	 * http://www.w3.org/1999/xhtml.
	 * @param string $localName either the local name of elements to look
	 * for or the special value "*", which matches all elements (see
	 * Element.localName and Attr.localName).
	 * @return HTMLCollection a live HTMLCollection of found elements in
	 * the order they appear in the tree.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/getElementsByTagNameNS
	 */
	public function getElementsByTagNameNS(
		string $namespaceURI,
		string $localName
	):HTMLCollection {

	}

	/**
	 * The Element.hasAttribute() method returns a Boolean value indicating
	 * whether the specified element has the specified attribute or not.
	 *
	 * @param string $name a string representing the name of the attribute.
	 * @return bool
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/hasAttribute
	 */
	public function hasAttribute(string $name):bool {

	}

	/**
	 * hasAttributeNS returns a boolean value indicating whether the current
	 * element has the specified attribute.
	 *
	 * @param string $namespace a string specifying the namespace of the
	 * attribute.
	 * @param string $localName the name of the attribute.
	 * @return bool
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/hasAttributeNS
	 */
	public function hasAttributeNS(
		string $namespace,
		string $localName
	):bool {
		return $this->getNativeElement()->hasAttributeNS(
			$namespace,
			$localName
		);
	}

	/**
	 * The hasAttributes() method of the Element interface returns a Boolean
	 * indicating whether the current element has any attributes or not.
	 *
	 * @return bool
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/hasAttributes
	 */
	public function hasAttributes():bool {

	}

	/**
	 * The insertAdjacentElement() method of the Element interface inserts
	 * a given element node at a given position relative to the element it
	 * is invoked upon.
	 *
	 * @param string $position A DOMString representing the position
	 * relative to the targetElement; must match (case-insensitively) one
	 * of the following strings:
	 * 'beforebegin': Before the targetElement itself.
	 * 'afterbegin': Just inside the targetElement, before its first child.
	 * 'beforeend': Just inside the targetElement, after its last child.
	 * 'afterend': After the targetElement itself.
	 *
	 * @param Element $element The element to be inserted into the tree.
	 * @return ?Element The element that was inserted, or null, if the
	 * insertion failed.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/insertAdjacentElement
	 */
	public function insertAdjacentElement(
		string $position,
		Element $element
	):?Element {

	}

	/**
	 * The insertAdjacentHTML() method of the Element interface parses the
	 * specified text as HTML or XML and inserts the resulting nodes into
	 * the DOM tree at a specified position. It does not reparse the element
	 * it is being used on, and thus it does not corrupt the existing
	 * elements inside that element. This avoids the extra step of
	 * serialization, making it much faster than direct innerHTML
	 * manipulation.
	 *
	 * @param string $position A DOMString representing the position
	 * relative to the element; must be one of the following strings:
	 * 'beforebegin': Before the element itself.
	 * 'afterbegin': Just inside the element, before its first child.
	 * 'beforeend': Just inside the element, after its last child.
	 * 'afterend': After the element itself.
	 * @param string $text The string to be parsed as HTML or XML and
	 * inserted into the tree.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/insertAdjacentHTML
	 */
	public function insertAdjacentHTML(
		string $position,
		string $text
	):void {

	}

	/**
	 * The insertAdjacentText() method of the Element interface inserts a
	 * given text node at a given position relative to the element it is
	 * invoked upon.
	 *
	 * @param string $position A DOMString representing the position
	 * relative to the element; must be one of the following strings:
	 * 'beforebegin': Before the element itself.
	 * 'afterbegin': Just inside the element, before its first child.
	 * 'beforeend': Just inside the element, after its last child.
	 * 'afterend': After the element itself.
	 * @param string $element A DOMString representing the text to be
	 * inserted into the tree.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/insertAdjacentText
	 */
	public function insertAdjacentText(
		string $position,
		string $element
	):void {

	}

	/**
	 * The matches() method checks to see if the Element would be selected
	 * by the provided selectorString -- in other words -- checks if the
	 * element "is" the selector.
	 *
	 * @param string $selectorString a string representing the selector to
	 * test.
	 * @return bool
	 * @throws SyntaxException if the specified selector string is invalid.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/matches
	 */
	public function matches(string $selectorString):bool {

	}

	/**
	 * The querySelector() method of the Element interface returns the first
	 * element that is a descendant of the element on which it is invoked
	 * that matches the specified group of selectors.
	 *
	 * @param string $selectors A group of selectors to match the descendant
	 * elements of the Element baseElement against; this must be valid CSS
	 * syntax, or a SyntaxException will occur. The first element
	 * found which matches this group of selectors is returned.
	 * @return ?Element
	 * @throws SyntaxException
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/querySelector
	 */
	public function querySelector(string $selectors):?Element {

	}

	/**
	 * The Element method querySelectorAll() returns a static (not live)
	 * NodeList representing a list of elements matching the specified group
	 * of selectors which are descendants of the element on which the method
	 * was called.
	 *
	 * @param string $selectors A DOMString containing one or more selectors
	 * to match against. This string must be a valid CSS selector string;
	 * if it's not, a SyntaxException is thrown. See Locating DOM elements
	 * using selectors for more information about using selectors to
	 * identify elements. Multiple selectors may be specified by separating
	 * them using commas.
	 * @return HTMLCollection A non-live NodeList containing one Element
	 * object for each descendant node that matches at least one of the
	 * specified selectors.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/querySelectorAll
	 */
	public function querySelectorAll(string $selectors):HTMLCollection {

	}

	/**
	 * The ChildNode.remove() method removes the object from the tree it
	 * belongs to.
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/ChildNode/remove
	 */
	public function remove():void {
		$this->domNode->parentNode->removeChild($this->domNode);
	}

	/**
	 * The Element method removeAttribute() removes the attribute with the
	 * specified name from the element.
	 *
	 * @param string $attrName A DOMString specifying the name of the
	 * attribute to remove from the element. If the specified attribute does
	 * not exist, removeAttribute() returns without generating an error.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/removeAttribute
	 */
	public function removeAttribute(string $attrName):void {

	}

	/**
	 * The removeAttributeNS() method of the Element interface removes the
	 * specified attribute from an element.
	 *
	 * @param string $namespace
	 * @param string $attrName
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/removeAttributeNS
	 */
	public function removeAttributeNS(
		string $namespace,
		string $attrName
	):void {

	}

	/**
	 * Sets the value of an attribute on the specified element. If the
	 * attribute already exists, the value is updated; otherwise a new
	 * attribute is added with the specified name and value.
	 *
	 * To get the current value of an attribute, use getAttribute(); to
	 * remove an attribute, call removeAttribute().
	 *
	 * @param string $name A DOMString specifying the name of the attribute
	 * whose value is to be set. The attribute name is automatically
	 * converted to all lower-case when setAttribute() is called on an HTML
	 * element in an HTML document.
	 * @param string $value A DOMString containing the value to assign to
	 * the attribute. Any non-string value specified is converted
	 * automatically into a string.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/setAttribute
	 */
	public function setAttribute(string $name, string $value):void {
		$this->getNativeElement()->setAttribute($name, $value);
	}

	/**
	 * setAttributeNS adds a new attribute or changes the value of an
	 * attribute with the given namespace and name.
	 *
	 * @param string $namespace a string specifying the namespace of the
	 * attribute.
	 * @param string $name a string identifying the attribute by its
	 * qualified name; that is, a namespace prefix followed by a colon
	 * followed by a local name.
	 * @param string $value the desired string value of the new attribute.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/setAttributeNS
	 */
	public function setAttributeNS(
		string $namespace,
		string $name,
		string $value
	):void {
		$this->getNativeElement()->setAttributeNS(
			$namespace,
			$name,
			$value
		);
	}

	/**
	 * The toggleAttribute() method of the Element interface toggles a
	 * Boolean attribute (removing it if it is present and adding it if it
	 * is not present) on the given element.
	 *
	 * @param string $name A DOMString specifying the name of the attribute
	 * to be toggled. The attribute name is automatically converted to all
	 * lower-case when toggleAttribute() is called on an HTML element in an
	 * HTML document.
	 * @param bool $force A boolean value to determine whether the attribute
	 * should be added or removed, no matter whether the attribute is
	 * present or not at the moment.
	 * @return true if attribute name is eventually present, and false
	 * otherwise.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/toggleAttribute
	 */
	public function toggleAttribute(
		string $name,
		bool $force = false
	):bool {

	}

	private function getNativeElement():DOMElementFacade {
		/** @var DOMElementFacade $native */
		$native = $this->domNode;
		return $native;
	}
}
