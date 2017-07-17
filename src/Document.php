<?php
namespace Gt\Dom;
use DOMNode;

/**
 * Represents any web page loaded in the browser and serves as an entry point
 * into the web page's content, the DOM tree (including elements such as
 * <body> or <table>).
 *
 * @method DocumentFragment createDocumentFragment(string) Create a new document fragment
 * from an xml string
 * @method Node importNode(DOMNode $importedNode, bool $deep = false)
 * @method NodeList getElementsByTagName(string $name)
 */
class Document extends \DOMDocument {
use LiveProperty, ParentNode;

public function __construct($document = null) {
	parent::__construct("1.0", "utf-8");
	$this->registerNodeClass("\\DOMNode", Node::class);
	$this->registerNodeClass("\\DOMElement", Element::class);
	$this->registerNodeClass("\\DOMAttr", Attr::class);
	$this->registerNodeClass("\\DOMDocumentFragment", DocumentFragment::class);
	$this->registerNodeClass("\\DOMDocumentType", DocumentType::class);
	$this->registerNodeClass("\\DOMCharacterData", CharacterData::class);
	$this->registerNodeClass("\\DOMText", Text::class);
	$this->registerNodeClass("\\DOMComment", Comment::class);

	if ($document instanceof \DOMDocument) {
		$node = $this->importNode($document->documentElement, true);
		$this->appendChild($node);
		return;
	}
}

protected  function getRootDocument(): \DOMDocument {
	return $this;
}

}#