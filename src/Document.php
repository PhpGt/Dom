<?php
namespace Gt\Dom;

use DOMAttr;
use DOMCharacterData;
use DOMComment;
use DOMDocument;
use DOMDocumentFragment;
use DOMDocumentType;
use DOMElement;
use DOMNode;
use DOMText;
use Gt\PropFunc\MagicProp;
use Psr\Http\Message\StreamInterface;
use RuntimeException;

/**
 * Represents any web page loaded in the browser and serves as an entry point
 * into the web page's content, the DOM tree (including elements such as
 * <body> or <table>).
 *
 * @property ?Node $body The Document.body property represents the <body> or <frameset> node of the current document, or null if no such element exists.
 * @property-read string $characterSet Returns the character set being used by the document.
 * @property-read string $compatMode Indicates whether the document is rendered in quirks or strict mode.
 * @property-read string $contentType Returns the Content-Type from the MIME Header of the current document.
 * @property-read string $doctype Returns the Document Type Definition (DTD) of the current document.
 * @property-read Element $documentElement Returns the Element that is a direct child of the document. For HTML documents, this is normally the HTMLHtmlElement object representing the document's <html> element.
 * @property-read HTMLCollection $embeds Returns a list of the embedded <embed> elements within the current document.
 * @property-read HTMLCollection $forms Returns a list of the <form> elements within the current document.
 * @property-read ?HTMLHeadElement $head Returns the <head> element of the current document.
 * @property-read HTMLCollection $images Returns a list of the images in the current document.
 * @property-read HTMLCollection $links Returns a list of all the hyperlinks in the document.
 * @property-read HTMLCollection $scripts Returns all the script elements on the document.
 * @property-read int $childElementCount Returns the number of children of this ParentNode which are elements.
 * @property-read HTMLCollection $children Returns a live HTMLCollection containing all of the Element objects that are children of this ParentNode, omitting all of its non-element nodes.
 * @property-read ?Element $firstElementChild Returns the first node which is both a child of this ParentNode and is also an Element, or null if there is none.
 * @property-read ?Element $lastElementChild Returns the last node which is both a child of this ParentNode and is an Element, or null if there is none.
 */
class Document extends Node implements StreamInterface {
	use MagicProp;
	use DocumentStream;
//	use ParentNode;

	protected DOMDocument $domDocument;

	public function __construct() {
		libxml_use_internal_errors(true);
		$this->domDocument = new DOMDocument(
			"1.0",
			"utf-8"
		);
		$this->stream = fopen("php://memory", "r+");
	}

	public function __toString():string {

	}

	/**
	 * Document.adoptNode() transfers a node from another document into the
	 * method's document. The adopted node and its subtree is removed from
	 * its original document (if any), and its ownerDocument is changed to
	 * the current document. The node can then be inserted into the current
	 * document.
	 */
	public function adoptNode(Node $externalNode):Node {

	}

	/**
	 * TODO: Move to ParentNode
	 * Inserts a set of Node objects or DOMString objects after the last
	 * child of the ParentNode. DOMString objects are inserted as
	 * equivalent Text nodes.
	 */
	public function append(string|Node... $nodesOrDOMStrings):void {

	}

	/**
	 * The Document.close() method finishes writing to a document,
	 * opened with Document.open().
	 */
	public function close():void {

	}

	/**
	 * The Document.createAttribute() method creates a new attribute node,
	 * and returns it. The object created a node implementing the Attr
	 * interface. The DOM does not enforce what sort of attributes can be
	 * added to a particular element in this manner.
	 */
	public function createAttribute(string $name):Attr {

	}

	/**
	 * Creates a new CDATA section node, and returns it.
	 */
	public function createCDATASection(string $data):CDATASection {

	}

	/**
	 * Creates a new comment node, and returns it.
	 */
	public function createComment():Comment {

	}

	/**
	 * Creates a new empty DocumentFragment into which DOM nodes can be
	 * added to build an offscreen DOM tree.
	 */
	public function createDocumentFragment():DocumentFragment {

	}

	/**
	 * In an HTML document, the document.createElement() method creates the
	 * HTML element specified by tagName, or an HTMLUnknownElement if
	 * tagName isn't recognized.
	 */
	public function createElement(string $tagName):Element {

	}

	/**
	 * Creates an element with the specified namespace URI and
	 * qualified name.
	 *
	 * To create an element without specifying a namespace URI, use
	 * the createElement() method.
	 */
	public function createElementNS(string $tagName, string $qualifiedName):Element {

	}

	/**
	 * TODO: Move to XPathEvaluator trait
	 * This method compiles an XPathExpression which can then be used for
	 * (repeated) evaluations.
	 */
	public function createExpression(string $xpathText, callable $resolver = null) {

	}

	/**
	 * Returns a new NodeIterator object.
	 */
	public function createNodeIterator(Node $root, int $whatToShow = null, NodeFilter $filter = null):NodeIterator {

	}

	/**
	 * TODO: Move to XPathEvaluator trait
	 * Creates an XPathNSResolver which resolves namespaces with respect to
	 * the definitions in scope for a specified node.
	 */
	public function createNSResolver(Node $node):XPathNSResolver {

	}

	/**
	 * createProcessingInstruction() generates a new processing instruction
	 * node and returns it.
	 *
	 * The new node usually will be inserted into an XML document in order
	 * to accomplish anything with it, such as with node.insertBefore.
	 */
	public function createProcessingInstruction(string $target, string $data):ProcessingInstruction {

	}

	/**
	 * Creates a new Text node. This method can be used to escape HTML
	 * characters.
	 */
	public function createTextNode(string $data):Text {

	}

	public function createTreeWalker(Node $root, int $whatToShow = null, NodeFilter $filter = null, bool $entityReferenceExpansion = null):TreeWalker {

	}

	/**
	 * TODO: Move to XPathEvaluator trait
	 * The evaluate() method of the XPathEvaluator interface executes an
	 * XPath expression on the given node or document and returns an
	 * XPathResult.
	 */
	public function evaluate(
		string $expression,
		Node $contextNode,
		XPathNSResolver $resolver = null,
		int $type = null,
		object $result = null
	):XPathResult {

	}

	/**
	 * The Document method getElementById() returns an Element object
	 * representing the element whose id property matches the specified
	 * string. Since element IDs are required to be unique if specified,
	 * they're a useful way to get access to a specific element quickly.
	 *
	 * If you need to get access to an element which doesn't have an ID,
	 * you can use querySelector() to find the element using any selector.
	 */
	public function getElementById(string $id):?Element {

	}

	/**
	 * The getElementsByClassName method of Document interface returns an
	 * array-like object of all child elements which have all of the given
	 * class name(s). When called on the document object, the complete
	 * document is searched, including the root node. You may also call
	 * getElementsByClassName() on any element; it will return only
	 * elements which are descendants of the specified root element with
	 * the given class name(s).
	 */
	public function getElementsByClassName(string $className):HTMLCollection {

	}

	/**
	 * The getElementsByName() method of the Document object returns a
	 * NodeList Collection of elements with a given name in the document.
	 */
	public function getElementsByName(string $name):NodeList {

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

	}

	/**
	 * Returns a list of elements with the given tag name belonging to the
	 * given namespace. The complete document is searched, including the
	 * root node.
	 */
	public function getElementsByTagNameNS(string $namespace, string $name):HTMLCollection {

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
	 */
	public function importNode(Node $externalNode, bool $deep = false):Node {

	}

	/**
	 * The Document.open() method opens a document for writing.
	 */
	public function open():void {

	}

	/**
	 * TODO: Move to ParentNode trait.
	 * The ParentNode.prepend() method inserts a set of Node objects or
	 * DOMString objects before the first child of the ParentNode.
	 * DOMString objects are inserted as equivalent Text nodes.
	 */
	public function prepend(string|Node... $nodesOrDOMStrings):void {

	}

	/**
	 * TODO: Move to ParentNode trait.
	 * The Document method querySelector() returns the first Element within
	 * the document that matches the specified selector, or group of
	 * selectors. If no matches are found, null is returned.
	 */
	public function querySelector(string $selectors):?Element {

	}

	/**
	 * TODO: Move to ParentNode trait.
	 *
	 * The Document method querySelectorAll() returns a static (not live)
	 * NodeList representing a list of the document's elements that match
	 * the specified group of selectors.
	 */
	public function querySelectorAll(string $selectors):NodeList {

	}

	/**
	 * TODO: Move to ParentNode trait.
	 *
	 * The ParentNode.replaceChildren() method replaces the existing
	 * children of a Node with a specified new set of children. These can
	 * be DOMString or Node objects.
	 */
	public function replaceChildren(string|Node...$nodesOrDOMStrings):void {

	}

	/**
	 * The Document.write() method writes a string of text to a document
	 * stream opened by document.open().
	 * @param string $markup
	 */
	public function write($markup):int {

	}

	/**
	 * Writes a string of text followed by a newline character to a
	 * document.
	 */
	public function writeln($line):int {

	}
}
