<?php
namespace Gt\Dom;

use DOMAttr;
use DOMCdataSection;
use DOMCharacterData;
use DOMComment;
use DOMDocument;
use DOMDocumentFragment;
use DOMDocumentType;
use DOMElement;
use DOMEntity;
use DOMEntityReference;
use DOMException;
use DOMNode;
use DOMNotation;
use DOMProcessingInstruction;
use DOMText;
use Gt\Dom\Exception\HTMLDocumentDoesNotSupportCDATASectionException;
use Gt\Dom\Exception\InvalidCharacterException;
use Gt\Dom\Exception\NotSupportedException;
use Psr\Http\Message\StreamInterface;
use ReturnTypeWillChange;
use Stringable;

/**
 * @property-read ?Element $documentElement Returns the Element that is a direct child of the document. For HTML documents, this is normally the HTMLHtmlElement object representing the document's <html> element.
 * @property-read DocumentType $doctype Returns the Document Type Definition (DTD) of the current document.
 *
 * @method Element importNode(Node|Element $node, bool $deep = false)
 * @method DocumentFragment createDocumentFragment()
 */
abstract class Document extends DOMDocument implements Stringable, StreamInterface {
	use DocumentStream;
	use ParentNode;
	use RegisteredNodeClass;

	const NodeClassLookup = [
		DOMDocument::class => Document::class,
		DOMAttr::class => Attr::class,
		DOMCdataSection::class => CdataSection::class,
		DOMCharacterData::class => CharacterData::class,
		DOMComment::class => Comment::class,
		DOMDocumentFragment::class => DocumentFragment::class,
		DOMDocumentType::class => DocumentType::class,
		DOMElement::class => Element::class,
		DOMEntity::class => Entity::class,
		DOMEntityReference::class => EntityReference::class,
		DOMNode::class => Node::class,
		DOMNotation::class => Notation::class,
		DOMText::class => Text::class,
		DOMProcessingInstruction::class => ProcessingInstruction::class,
	];

	public function __construct(
		public readonly string $characterSet,
		public readonly string $contentType,
	) {
		parent::__construct("1.0", $this->characterSet);
		$this->registerNodeClasses();
		libxml_use_internal_errors(true);
	}

	public function __toString():string {
		if(get_class($this) === HTMLDocument::class) {
			$string = $this->saveHTML();
		}
		else {
			$string = $this->saveXML();
		}

		$string = mb_convert_encoding(
			$string,
			"UTF-8",
			"HTML-ENTITIES"
		);
		return trim($string) . "\n";
	}

	/**
	 * The Document.createAttribute() method creates a new attribute node,
	 * and returns it. The object created a node implementing the Attr
	 * interface. The DOM does not enforce what sort of attributes can be
	 * added to a particular element in this manner.
	 *
	 * @param string $localName name is a string containing the name of the
	 * attribute.
	 * @return Attr A Attr node.
	 * @throws InvalidCharacterException if the parameter contains invalid
	 * characters for XML attribute
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/createAttribute
	 */
	public function createAttribute(string $localName = ""):Attr {
		/** @var Attr $attr */
		$attr = parent::createAttribute($localName);
		return $attr;
	}

	/**
	 * Currently undocumented at MDN. Please see W3C spec instead.
	 * @link https://dom.spec.whatwg.org/#dom-document-createattributens
	 *
	 * @param ?string $namespace
	 * @param string $qualifiedName
	 * @return Attr
	 */
	public function createAttributeNS(
		?string $namespace,
		string $qualifiedName
	):Attr {
		/** @var Attr $attr */
		$attr = parent::createAttributeNS($namespace, $qualifiedName);
		return $attr;
	}

	/**
	 * Creates a new CDATA section node, and returns it.
	 * This will only work with XML, not HTML documents (as HTML documents
	 * do not support CDATA sections); attempting it on an HTML document
	 * will throw NotSupportedException.
	 *
	 * @param string $data data is a string containing the data to be added
	 * to the CDATA Section.
	 * @return CdataSection a CDATA Section node.
	 * @throws NotSupportedException
	 * @throws InvalidCharacterException if one tries to submit the
	 * closing CDATA sequence ("]]>") as part of the data, so unescaped
	 * user-provided data cannot be safely used without this method getting
	 * this exception (createTextNode() can often be used in its place).
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/createCDATASection
	 */
	public function createCDATASection(string $data):CdataSection {
		if($this instanceof HTMLDocument) {
			throw new HTMLDocumentDoesNotSupportCDATASectionException();
		}

		$closingTag = "]]>";
		if(strstr($data, $closingTag)) {
			throw new InvalidCharacterException($closingTag);
		}

		/** @var CdataSection $cdata */
		$cdata = parent::createCDATASection($data);
		return $cdata;
	}

	/**
	 * In an HTML document, the document.createElement() method creates the
	 * HTML element specified by tagName, or an HTMLUnknownElement if
	 * tagName isn't recognized.
	 *
	 * @param string $localName A string that specifies the type of element
	 * to be created. The nodeName of the created element is initialized
	 * with the value of tagName. Don't use qualified names (like "html:a")
	 * with this method. When called on an HTML document, createElement()
	 * converts tagName to lower case before creating the element.
	 * @param string $value The value of the element. By default, an empty
	 * element will be created. You can also set the value later with
	 * DOMElement->nodeValue.
	 * @return Element The new Element.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/createElement
	 */
	public function createElement(string $localName, string $value = ""):Element {
		$localName = strtolower($localName);
		try {
			/** @var Element $element */
			$element = parent::createElement($localName, $value);
			return $element;
		}
		catch(DOMException $exception) {
			throw new InvalidCharacterException();
		}
	}

	/**
	 * Creates an element with the specified namespace URI and
	 * qualified name.
	 *
	 * To create an element without specifying a namespace URI, use
	 * the createElement() method.
	 *
	 * @param string $namespace A string that specifies the namespace URI
	 * to associate with the element. The namespaceURI property of the
	 * created element is initialized with the value of namespaceURI.
	 * @param string $qualifiedName A string that specifies the type of
	 * element to be created. The nodeName property of the created element
	 * is initialized with the value of qualifiedName.
	 * @param string $value The value of the element. By default, an empty
	 * element will be created. You can also set the value later with
	 * DOMElement->nodeValue.
	 * @return Element The new Element.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/createElementNS
	 */
	public function createElementNS(?string $namespace = "", string $qualifiedName = "", string $value = ""):Element {
		/** @var Element $element */
		$element = parent::createElementNS($namespace, $qualifiedName, $value);
		return $element;
	}

	/**
	 * Returns a new NodeIterator object.
	 *
	 * @param Node $root The root node at which to begin the NodeIterator's
	 * traversal.
	 * @param int $whatToShow Is an optional unsigned long representing a
	 * bitmask created by combining the constant properties of NodeFilter.
	 * It is a convenient way of filtering for certain types of node.
	 * It defaults to 0xFFFFFFFF representing the SHOW_ALL constant.
	 * @param NodeFilter|callable|null $filter An object implementing the
	 * NodeFilter interface. Its acceptNode() method will be called for each
	 * node in the subtree based at root which is accepted as included by
	 * the whatToShow flag to determine whether or not to include it in the
	 * list of iterable nodes (a simple callback function may also be used
	 * instead). The method should return one of NodeFilter.FILTER_ACCEPT,
	 * NodeFilter.FILTER_REJECT, or NodeFilter.FILTER_SKIP.
	 * @return NodeIterator
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/createNodeIterator
	 */
	public function createNodeIterator(
		Node|Element $root,
		int $whatToShow = NodeFilter::SHOW_ALL,
		NodeFilter|callable $filter = null
	):NodeIterator {
		return NodeIteratorFactory::create($root, $whatToShow, $filter);
	}

	/**
	 * createProcessingInstruction() generates a new processing instruction
	 * node and returns it.
	 *
	 * The new node usually will be inserted into an XML document in order
	 * to accomplish anything with it, such as with node.insertBefore.
	 *
	 * @param string $target a string containing the first part of the
	 * processing instruction (i.e., <?target … ?>)
	 * @param null|string $data a string containing any information the
	 * processing instruction should carry, after the target. The data is
	 * up to you, but it can't contain ?>, since that closes the processing
	 * instruction.
	 * @return ProcessingInstruction the resulting ProcessingInstruction
	 * node.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/createProcessingInstruction
	 */
	public function createProcessingInstruction(
		string $target,
		?string $data = null
	):ProcessingInstruction {
		$closingTag = "?>";
		if(strstr($data, $closingTag)) {
			throw new InvalidCharacterException($closingTag);
		}

		/** @var ProcessingInstruction $processingInstruction */
		$processingInstruction = parent::createProcessingInstruction($target, $data);
		return $processingInstruction;
	}

	/**
	 * The Document.createTreeWalker() creator method returns a newly
	 * created TreeWalker object.
	 *
	 * @param Node $root A root Node of this TreeWalker traversal. Typically
	 * this will be an element owned by the document.
	 * @param int $whatToShow A unsigned long representing a bitmask
	 * created by combining the constant properties of NodeFilter. It is a
	 * convenient way of filtering for certain types of node. It defaults
	 * to 0xFFFFFFFF representing the SHOW_ALL constant.
	 * @param NodeFilter|callable|null $filter A NodeFilter, that is an
	 * object with a method acceptNode, which is called by the TreeWalker
	 * to determine whether or not to accept a node that has passed the
	 * whatToShow check. Alternatively pass the callable that represents
	 * `acceptNode` function.
	 * @return TreeWalker A new TreeWalker object.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/createTreeWalker
	 */
	public function createTreeWalker(
		Node|Element $root,
		int $whatToShow = NodeFilter::SHOW_ALL,
		NodeFilter|callable $filter = null
	):TreeWalker {
		return TreeWalkerFactory::create($root, $whatToShow, $filter);
	}

	/**
	 * Returns an XPathResult based on an XPath expression.
	 *
	 * @param string $xpathExpression is a string representing the XPath to
	 * be evaluated.
	 * @param null|Node|Element $contextNode Leave null to default to $this node
	 * @return XPathResult
	 */
	public function evaluate(
		string $xpathExpression,
		null|Node|Element $contextNode = null
	):XPathResult {
		if(!$contextNode) {
			$contextNode = $this->documentElement;
		}

		return XPathResultFactory::create(
			$xpathExpression,
			$this,
			$contextNode,
		);
	}

	/**
	 * The Document method getElementById() returns an Element object
	 * representing the element whose id property matches the specified
	 * string. Since element IDs are required to be unique if specified,
	 * they're a useful way to get access to a specific element quickly.
	 *
	 * If you need to get access to an element which doesn't have an ID,
	 * you can use querySelector() to find the element using any selector.
	 *
	 * @param string $elementId The ID of the element to locate. The ID is
	 * case-sensitive string which is unique within the document; only one
	 * element may have any given ID.
	 * @return ?Element An Element object describing the DOM element object
	 * matching the specified ID, or null if no matching element was found
	 * in the document.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/getElementById
	 */
	public function getElementById(string $elementId):?Element {
		/** @var ?Element $element */
		$element = parent::getElementById($elementId);

		if(is_null($element) && $this instanceof XMLDocument) {
// Known limitation in XML documents: IDs are not always registered.
// Try using XPath instead.
			$element = $this->evaluate("//*[@id='$elementId']")->current();
		}

		return $element;
	}

	/**
	 * The getElementsByClassName method of Document interface returns an
	 * array-like object of all child elements which have all of the given
	 * class name(s). When called on the document object, the complete
	 * document is searched, including the root node. You may also call
	 * getElementsByClassName() on any element; it will return only
	 * elements which are descendants of the specified root element with
	 * the given class name(s).
	 *
	 * @param string $names a string representing the class name(s) to
	 * match; multiple class names are separated by whitespace.
	 * @return HTMLCollection a live HTMLCollection of found elements.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/getElementsByClassName
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

	/**
	 * The getElementsByName() method of the Document object returns a
	 * NodeList Collection of elements with a given name in the document.
	 *
	 * @param string $name the value of the name attribute of the
	 * element(s).
	 * @return NodeList a live NodeList Collection, meaning it automatically
	 * updates as new elements with the same name are added to/removed from
	 * the document.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/getElementsByName
	 */
	public function getElementsByName(string $name):NodeList {
		$querySelector = "[name=$name]";
		return NodeListFactory::createLive(
			fn() => $this->querySelectorAll($querySelector)
		);
	}

	/**
	 * The getElementsByTagName method of Document interface returns an
	 * HTMLCollection of elements with the given tag name. The complete
	 * document is searched, including the root node. The returned
	 * HTMLCollection is live, meaning that it updates itself automatically
	 * to stay in sync with the DOM tree without having to call
	 * document.getElementsByTagName() again.
	 * @return HTMLCollection<Element>
	 * @phpstan-ignore-next-line
	 */
	#[ReturnTypeWillChange]
	public function getElementsByTagName(string $qualifiedName):HTMLCollection {
		return HTMLCollectionFactory::create(function() use($qualifiedName) {
			return parent::getElementsByTagName($qualifiedName);
		});
	}

	/**
	 * @see Node::isEqualNode()
	 * @param Node|Element $otherNode
	 * @noinspection PhpParameterNameChangedDuringInheritanceInspection
	 */
	public function isEqualNode(Node|Element|DOMNode $otherNode):bool {
		return $this->documentElement->isEqualNode($otherNode);
	}

	/**
	 * Writes a string of text followed by a newline character to a
	 * document.
	 *
	 * @param string $line line is string containing a line of text.
	 * @return int The number of bytes written.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/writeln
	 * @noinspection PhpMissingParamTypeInspection
	 */
	public function writeln($line):int {
		return $this->write($line . PHP_EOL);
	}

	private function registerNodeClasses():void {
		foreach(self::NodeClassLookup as $nativeClass => $gtClass) {
			$this->registerNodeClass($nativeClass, $gtClass);
		}
	}
}
