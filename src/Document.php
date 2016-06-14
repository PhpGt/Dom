<?php
namespace phpgt\dom;

/**
 * Represents any web page loaded in the browser and serves as an entry point
 * into the web page's content, the DOM tree (including elements such as
 * <body> or <table>).
 */
class Document extends \DOMDocument {
use LiveProperty, ParentNode;

public function __construct($document = null) {
	parent::__construct("1.0", "utf-8");
	$this->registerNodeClass("\DOMNode", "\phpgt\dom\Node");
	$this->registerNodeClass("\DOMElement", "\phpgt\dom\Element");
	$this->registerNodeClass("\DOMAttr", "\phpgt\dom\Attr");
	$this->registerNodeClass("\DOMDocumentFragment",
		"\phpgt\dom\DocumentFragment");
	$this->registerNodeClass("\DOMDocumentType", "\phpgt\dom\DocumentType");
	$this->registerNodeClass("\DOMCharacterData", "\phpgt\dom\CharacterData");
	$this->registerNodeClass("\DOMText", "\phpgt\dom\Text");
	$this->registerNodeClass("\DOMComment", "\phpgt\dom\Comment");
    if ($document instanceof \DOMDocument) {
        $this->appendChild($this->importNode($document->documentElement, true));
        return;
    }
}

};