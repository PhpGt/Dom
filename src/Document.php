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
	$this->registerNodeClass("\\DOMNode", "\\Gt\\Dom\\Node");
	$this->registerNodeClass("\\DOMElement", "\\Gt\\Dom\\Element");
	$this->registerNodeClass("\\DOMAttr", "\\Gt\\Dom\\Attr");
	$this->registerNodeClass("\\DOMDocumentFragment",
		"\\Gt\\Dom\\DocumentFragment");
	$this->registerNodeClass("\\DOMDocumentType", "\\Gt\\Dom\\DocumentType");
	$this->registerNodeClass("\\DOMCharacterData", "\\Gt\\Dom\\CharacterData");
	$this->registerNodeClass("\\DOMText", "\\Gt\\Dom\\Text");
	$this->registerNodeClass("\\DOMComment", "\\Gt\\Dom\\Comment");
    if ($document instanceof \DOMDocument) {
        $this->appendChild($this->importNode($document->documentElement, true));
        return;
    }
}

};
