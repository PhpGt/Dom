<?php
namespace Gt\Dom;

use DOMException;
use DOMNode;
use Gt\Dom\Exception\HTMLDocumentDoesNotSupportCDATASectionException;
use Gt\Dom\Exception\InvalidCharacterException;
use Gt\Dom\Exception\NotSupportedException;
use Gt\Dom\Facade\DOMDocumentFacade;
use Gt\Dom\Facade\DOMImplementationFactory;
use Gt\Dom\Facade\HTMLCollectionFactory;
use Gt\Dom\Facade\NodeClass\DOMNodeFacade;
use Gt\Dom\Facade\NodeIteratorFactory;
use Gt\Dom\Facade\NodeListFactory;
use Gt\Dom\Facade\TreeWalkerFactory;
use Gt\Dom\Facade\XPathResultFactory;
use Gt\Dom\HTMLElement\HTMLBodyElement;
use Gt\Dom\HTMLElement\HTMLHeadElement;
use Gt\Dom\HTMLElement\HTMLTitleElement;
use Gt\PropFunc\MagicProp;
use Psr\Http\Message\StreamInterface;

/**
 * Represents any web page loaded in the browser and serves as an entry point
 * into the web page's content, the DOM tree (including elements such as
 * <body> or <table>).
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document
 *
 * @property-read ?HTMLBodyElement $body The Document.body property represents the <body> or <frameset> node of the current document, or null if no such element exists.
 * @property-read string $characterSet Returns the character set being used by the document.
 * @property-read string $contentType Returns the Content-Type from the MIME Header of the current document.
 * @property-read ?DocumentType $doctype Returns the Document Type Definition (DTD) of the current document.
 * @property-read ?Element $documentElement Returns the Element that is a direct child of the document. For HTML documents, this is normally the HTMLHtmlElement object representing the document's <html> element.
 * @property-read HTMLCollection $embeds Returns a list of the embedded <embed> elements within the current document.
 * @property-read HTMLCollection $forms Returns a list of the <form> elements within the current document.
 * @property-read ?HTMLHeadElement $head Returns the <head> element of the current document.
 * @property-read HTMLCollection $images Returns a list of the images in the current document.
 * @property-read DOMImplementation $implementation Returns the DOM implementation associated with the current document.
 * @property-read HTMLCollection $links Returns a list of all the hyperlinks in the document.
 * @property-read HTMLCollection $scripts Returns all the script elements on the document.
 * @property string $title Sets or gets the title of the current document.
 */
class Document extends Node implements StreamInterface {
	use MagicProp;
	use DocumentStream;
	use ParentNode;

	protected DOMDocumentFacade $domDocument;

	public function __construct() {
		libxml_use_internal_errors(true);
		$this->domDocument = new DOMDocumentFacade(
			$this,
			"1.0",
			"utf-8"
		);

		parent::__construct($this->domDocument);
	}

	public function __toString():string {
		if($this instanceof XMLDocument) {
			$string = $this->domDocument->saveXML();
		}
		else {
			$string = $this->domDocument->saveHTML();
		}

		return $string;
	}

	public function getGtDomNode(DOMNode $nativeNode):Node {
		return $this->domDocument->getGtDomNode($nativeNode);
	}

	public function getNativeDomNode(Node $gtNode):DOMNode {
		/** @var DOMNodeFacade $nativeDomNode */
		$nativeDomNode = $this->domDocument->getNativeDomNode($gtNode);
		return $nativeDomNode;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Document/body */
	protected function __prop_get_body():?Node {
		$domBody = $this->domDocument->getElementsByTagName("body")->item(0);
		if(!$domBody) {
			return null;
		}

		return $this->domDocument->getGtDomNode($domBody);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Document/characterSet */
	protected function __prop_get_characterSet():string {
		$encoding = $this->domDocument->encoding;
		if(!$encoding) {
			return "";
		}

		return strtoupper($encoding);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Document/contentType */
	protected function __prop_get_contentType():string {
		return "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Document/doctype */
	protected function __prop_get_doctype():?DocumentType {
		$domDoctype = $this->domDocument->getNativeDomNode($this)->doctype;
		if(!$domDoctype) {
			return null;
		}

		/** @var DocumentType $gtNode */
		$gtNode = $this->domDocument->getGtDomNode($domDoctype);
		return $gtNode;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Document/documentElement */
	protected function __prop_get_documentElement():?Element {
		$domDocumentElement = $this->domDocument->documentElement;
		if(!$domDocumentElement) {
			return null;
		}

		/** @var Element $gtNode */
		$gtNode = $this->domDocument->getGtDomNode($domDocumentElement);
		return $gtNode;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Document/embeds */
	protected function __prop_get_embeds():HTMLCollection {
		return $this->getElementsByTagName("embed");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Document/forms */
	protected function __prop_get_forms():HTMLCollection {
		return $this->getElementsByTagName("form");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Document/head */
	protected function __prop_get_head():?HTMLHeadElement {
		if(!$this instanceof HTMLDocument) {
			return null;
		}

		$nativeNode = $this->domDocument->getElementsByTagName(
			"head")->item(0);

		if(!$nativeNode) {
			return null;
		}

		/** @var HTMLHeadElement $gtNode */
		$gtNode = $this->domDocument->getGtDomNode($nativeNode);
		return $gtNode;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Document/images */
	protected function __prop_get_images():HTMLCollection {
		return $this->getElementsByTagName("img");
	}

	protected function __prop_get_implementation():DOMImplementation {
		return DOMImplementationFactory::create($this);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Document/links */
	protected function __prop_get_links():HTMLCollection {
		return HTMLCollectionFactory::create(function() {
			$gtNodeArray = [];

			$areaList = $this->domDocument->getElementsByTagName("area");
			for($i = 0, $len = $areaList->length; $i < $len; $i++) {
				$gtNode = $this->domDocument->getGtDomNode(
					$areaList->item($i)
				);
				array_push($gtNodeArray, $gtNode);
			}
			$aList = $this->domDocument->getElementsByTagName("a");
			for($i = 0, $len = $aList->length; $i < $len; $i++) {
				$domNode = $aList->item($i);
				$hrefAttr = $domNode->attributes->getNamedItem(
					"href"
				);
				if(!$hrefAttr) {
					continue;
				}

				$gtNode = $this->domDocument->getGtDomNode(
					$aList->item($i)
				);
				array_push($gtNodeArray, $gtNode);
			}

			return NodeListFactory::create(...$gtNodeArray);
		});
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Document/scripts */
	protected function __prop_get_scripts():HTMLCollection {
		return $this->getElementsByTagName("script");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Document/title */
	protected function __prop_get_title():string {
		/** @var HTMLTitleElement|null $titleElement */
		$titleElement = $this->head?->getElementsByTagName("title")?->item(0);
		return $titleElement?->text ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Document/title */
	protected function __prop_set_title(string $value):void {
		if(!$titleElement = $this->head?->getElementsByTagName("title")?->item(0)) {
			$titleElement = $this->createElement("title");
			$this->head->appendChild($titleElement);
		}

		/** @var HTMLTitleElement $titleElement */
		$titleElement->text = $value;
	}

	/**
	 * Document.adoptNode() transfers a node from another document into the
	 * method's document. The adopted node and its subtree is removed from
	 * its original document (if any), and its ownerDocument is changed to
	 * the current document. The node can then be inserted into the current
	 * document.
	 *
	 * @param Node $externalNode The node from another document to be
	 * adopted.
	 * @return Node The copied importedNode in the scope of the importing
	 * document. After calling this method, importedNode and externalNode
	 * are the same object.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/adoptNode
	 */
	public function adoptNode(Node &$externalNode):Node {
		$nativeNode = $this->getNativeDomNode($externalNode);

		if($nativeNode->ownerDocument === $this->domDocument) {
			return $externalNode;
		}

		if($nativeNode->parentNode) {
			$nativeNode->parentNode->removeChild($nativeNode);
		}
		$importedNode = $this->domDocument->importNode(
			$nativeNode,
			true
		);

		// Overwrite node (passed by reference).
		$externalNode = $this->domDocument->getGtDomNode($importedNode);
		return $externalNode;
	}

	/**
	 * The Document.createAttribute() method creates a new attribute node,
	 * and returns it. The object created a node implementing the Attr
	 * interface. The DOM does not enforce what sort of attributes can be
	 * added to a particular element in this manner.
	 *
	 * @param string $name name is a string containing the name of the
	 * attribute.
	 * @return Attr A Attr node.
	 * @throws InvalidCharacterException if the parameter contains invalid
	 * characters for XML attribute
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/createAttribute
	 */
	public function createAttribute(string $name):Attr {
		$nativeAttr = $this->domDocument->createAttribute($name);
		/** @var Attr $gtAttr */
		$gtAttr = $this->getGtDomNode($nativeAttr);
		return $gtAttr;
	}

	/**
	 * Currently undocumented at MDN. Please see W3C spec instead.
	 * @link https://dom.spec.whatwg.org/#dom-document-createattributens
	 *
	 * @param string $namespace
	 * @param string $qualifiedName
	 * @return Attr
	 */
	public function createAttributeNS(
		string $namespace,
		string $qualifiedName
	):Attr {
		$nativeAttr = $this->domDocument->createAttributeNS(
			$namespace,
			$qualifiedName
		);
		/** @var Attr $gtAttr */
		$gtAttr = $this->getGtDomNode($nativeAttr);
		return $gtAttr;
	}

	/**
	 * Creates a new CDATA section node, and returns it.
	 * This will only work with XML, not HTML documents (as HTML documents
	 * do not support CDATA sections); attempting it on an HTML document
	 * will throw NotSupportedException.
	 *
	 * @param string $data data is a string containing the data to be added
	 * to the CDATA Section.
	 * @return CDATASection a CDATA Section node.
	 * @throws NotSupportedException
	 * @throws InvalidCharacterException if one tries to submit the
	 * closing CDATA sequence ("]]>") as part of the data, so unescaped
	 * user-provided data cannot be safely used without this method getting
	 * this exception (createTextNode() can often be used in its place).
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/createCDATASection
	 */
	public function createCDATASection(string $data):CDATASection {
		if($this instanceof HTMLDocument) {
			throw new HTMLDocumentDoesNotSupportCDATASectionException();
		}

		$closingTag = "]]>";
		if(strstr($data, $closingTag)) {
			throw new InvalidCharacterException($closingTag);
		}

		$nativeCDATA = $this->domDocument->createCDATASection($data);
		/** @var CDATASection $gtCDATA */
		$gtCDATA = $this->getGtDomNode($nativeCDATA);
		return $gtCDATA;
	}

	/**
	 * Creates a new comment node, and returns it.
	 *
	 * @param string $data A string containing the data to be added to the
	 * Comment.
	 * @return Comment
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/createComment
	 */
	public function createComment(string $data):Comment {
		$domComment = $this->domDocument->createComment($data);
		/** @var Comment $gtComment */
		$gtComment = $this->getGtDomNode($domComment);
		return $gtComment;
	}

	/**
	 * Creates a new empty DocumentFragment into which DOM nodes can be
	 * added to build an offscreen DOM tree.
	 *
	 * @return DocumentFragment A newly created, empty, DocumentFragment
	 * object, which is ready to have nodes inserted into it.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/createDocumentFragment
	 */
	public function createDocumentFragment():DocumentFragment {
		$domFragment = $this->domDocument->createDocumentFragment();
		/** @var DocumentFragment $gtFragment */
		$gtFragment = $this->getGtDomNode($domFragment);
		return $gtFragment;
	}

	/**
	 * In an HTML document, the document.createElement() method creates the
	 * HTML element specified by tagName, or an HTMLUnknownElement if
	 * tagName isn't recognized.
	 *
	 * @param string $tagName A string that specifies the type of element
	 * to be created. The nodeName of the created element is initialized
	 * with the value of tagName. Don't use qualified names (like "html:a")
	 * with this method. When called on an HTML document, createElement()
	 * converts tagName to lower case before creating the element.
	 * @return Element The new Element.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/createElement
	 */
	public function createElement(string $tagName):Element {
		$element = null;

		try {
			$domElement = $this->domDocument->createElement(
				$tagName
			);
			/** @var Element $element */
			$element = $this->domDocument->getGtDomNode($domElement);
		}
		/** @noinspection PhpRedundantCatchClauseInspection */
		catch(DOMException $exception) {
			if(strstr($exception->getMessage(), "Invalid Character Error")) {
				throw new InvalidCharacterException($tagName);
			}
		}

		return $element;
	}

	/**
	 * Creates an element with the specified namespace URI and
	 * qualified name.
	 *
	 * To create an element without specifying a namespace URI, use
	 * the createElement() method.
	 *
	 * @param string $namespaceURI A string that specifies the namespace URI
	 * to associate with the element. The namespaceURI property of the
	 * created element is initialized with the value of namespaceURI.
	 * @param string $qualifiedName A string that specifies the type of
	 * element to be created. The nodeName property of the created element
	 * is initialized with the value of qualifiedName.
	 * @return Element The new Element.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/createElementNS
	 */
	public function createElementNS(
		string $namespaceURI,
		string $qualifiedName
	):Element {
		$domElement = $this->domDocument->createElementNS(
			$namespaceURI,
			$qualifiedName
		);
		/** @var Element $gtElement */
		$gtElement = $this->getGtDomNode($domElement);
		return $gtElement;
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
		Node $root,
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
	 * @param string $data a string containing any information the
	 * processing instruction should carry, after the target. The data is
	 * up to you, but it can't contain ?>, since that closes the processing
	 * instruction.
	 * @return ProcessingInstruction the resulting ProcessingInstruction
	 * node.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/createProcessingInstruction
	 */
	public function createProcessingInstruction(
		string $target,
		string $data
	):ProcessingInstruction {
		$closingTag = "?>";
		if(strstr($data, $closingTag)) {
			throw new InvalidCharacterException($closingTag);
		}

		$domProcessingInstruction = $this->domDocument->createProcessingInstruction($target, $data);
		/** @var ProcessingInstruction $gtProcessingInstruction */
		$gtProcessingInstruction = $this->getGtDomNode($domProcessingInstruction);
		return $gtProcessingInstruction;
	}

	/**
	 * Creates a new Text node. This method can be used to escape HTML
	 * characters.
	 *
	 * @param string $data a string containing the data to be put in the
	 * text node.
	 * @return Text a Text node.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/createTextNode
	 */
	public function createTextNode(string $data):Text {
		$nativeNode = $this->domDocument->createTextNode($data);
		/** @var Text $gtNode */
		$gtNode = $this->domDocument->getGtDomNode($nativeNode);
		return $gtNode;
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
		Node $root,
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
	 * @param ?Node $contextNode Leave null to default to $this node
	 * @return XPathResult
	 */
	public function evaluate(
		string $xpathExpression,
		Node $contextNode = null
	):XPathResult {
		if(!$contextNode) {
			$contextNode = $this;
		}

		/** @var DOMNodeFacade $nativeContextNode */
		$nativeContextNode = $this->getNativeDomNode($contextNode);
		return XPathResultFactory::create(
			$xpathExpression,
			$this->domDocument,
			$nativeContextNode
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
	 * @param string $id The ID of the element to locate. The ID is
	 * case-sensitive string which is unique within the document; only one
	 * element may have any given ID.
	 * @return ?Element An Element object describing the DOM element object
	 * matching the specified ID, or null if no matching element was found
	 * in the document.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/getElementById
	 */
	public function getElementById(string $id):?Element {
		$domElement = $this->domDocument->getElementById($id);
		if(!$domElement) {
			if($this instanceof XMLDocument) {
// Known limitation in XML documents: IDs are not always registered.
// Try using XPath instead.
				/** @var ?Element $node */
				$node = $this->evaluate("//*[@id='$id']")->current();
				return $node;
			}

			return null;
		}

		/** @var Element $gtElement */
		$gtElement = $this->getGtDomNode($domElement);
		return $gtElement;
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
	 */
	public function getElementsByTagName(string $name):HTMLCollection {
		return HTMLCollectionFactory::create(function()use($name) {
			$gtDomNodeArray = [];

			$domNodeList = $this->domDocument->getElementsByTagName($name);
			for($i = 0, $len = $domNodeList->length; $i < $len; $i++) {
				$gtDomNode = $this->domDocument->getGtDomNode(
					$domNodeList->item($i)
				);
				array_push(
					$gtDomNodeArray,
					$gtDomNode
				);
			}

			return NodeListFactory::create(...$gtDomNodeArray);
		});
	}

	/**
	 * Returns a list of elements with the given tag name belonging to the
	 * given namespace. The complete document is searched, including the
	 * root node.
	 *
	 * @param string $namespace the namespace URI of elements to look for.
	 * @param string $name either the local name of elements to look for or
	 * the special value *, which matches all elements.
	 * @return HTMLCollection a live NodeList (but see the note below) of
	 * found elements in the order they appear in the tree.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/getElementsByTagNameNS
	 *
	 * Note: While the W3C specification says elements is a NodeList, this
	 * method returns a HTMLCollection both in Gecko and Internet Explorer.
	 * Opera returns a NodeList, but with a namedItem method implemented,
	 * which makes it similar to a HTMLCollection.
	 */
	public function getElementsByTagNameNS(
		string $namespace,
		string $name
	):HTMLCollection {
		return HTMLCollectionFactory::create(function()use($namespace, $name) {
			$gtDomNodeArray = [];

			$domNodeList = $this->domDocument->getElementsByTagNameNS(
				$namespace,
				$name
			);

			for($i = 0, $len = $domNodeList->length; $i < $len; $i++) {
				$gtDomNode = $this->domDocument->getGtDomNode(
					$domNodeList->item($i)
				);
				array_push(
					$gtDomNodeArray,
					$gtDomNode
				);
			}

			return NodeListFactory::create(...$gtDomNodeArray);
		});

	}

	/**
	 * The Document object's importNode() method creates a copy of a Node
	 * or DocumentFragment from another document, to be inserted into the
	 * current document later.
	 *
	 * The imported node is not yet included in the document tree. To
	 * include it, you need to call an insertion method such as
	 * appendChild() or insertBefore() with a node that is currently in the
	 * document tree.
	 *
	 * Unlike document.adoptNode(), the original node is not removed from
	 * its original document. The imported node is a clone of the original.
	 *
	 * @param Node $externalNode The external Node or DocumentFragment to
	 * import into the current document.
	 * @param bool $deep A Boolean which controls whether to include the
	 * entire DOM subtree of the externalNode in the import. If deep is set
	 * to true, then externalNode and all of its descendants are copied. If
	 * deep is set to false, then only externalNode is imported — the new
	 * node has no children.
	 * @return Node The copied importedNode in the scope of the importing
	 * document.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/importNode
	 */
	public function importNode(
		Node $externalNode,
		bool $deep = false
	):Node {
		$nativeNode = $this->getNativeDomNode($externalNode);
		$newNativeNode = $this->domDocument->importNode(
			$nativeNode,
			$deep
		);

		return $this->getGtDomNode($newNativeNode);
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
}
