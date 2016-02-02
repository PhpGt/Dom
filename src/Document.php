<?php
namespace phpgt\dom;

class Document extends \DOMDocument {

private $elementMap = [];

public function __construct() {
	parent::__construct("1.0", "utf-8");
	$this->registerNodeClass("\DOMNode", "\phpgt\dom\Node");
	$this->registerNodeClass("\DOMElement", "\phpgt\dom\Element");
	$this->registerNodeClass("\DOMAttr", "\phpgt\dom\Attr");
	$this->registerNodeClass("\DOMDocumentFragment",
		"\phpgt\dom\DocumentFragment");
	$this->registerNodeClass("\DOMDocumentType", "\phpgt\dom\DocumentType");
	$this->registerNodeClass("\DOMCharacterData", "\phpgt\dom\CharacterData");
	$this->registerNodeClass("\DOMText", "\phpgt\dom\Text");
}

};