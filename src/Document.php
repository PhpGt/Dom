<?php
namespace Gt\Dom;

/**
 * Represents any web page loaded in the browser and serves as an entry point
 * into the web page's content, the DOM tree (including elements such as
 * <body> or <table>).
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
        $this->appendChild($this->importNode($document->documentElement, true));
        return;
    }
}

protected  function getRootDocument(): \DOMDocument
{
    return $this;
}
};
