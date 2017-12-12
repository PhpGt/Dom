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
class Document extends DOMDocument {
	use LiveProperty, ParentNode;

	public function __construct($document = null) {
		libxml_use_internal_errors(true);
		parent::__construct("1.0", "utf-8");
		$this->registerNodeClass(DOMNode::class, Node::class);
		$this->registerNodeClass(DOMElement::class, Element::class);
		$this->registerNodeClass(DOMAttr::class, Attr::class);
		$this->registerNodeClass(DOMDocumentFragment::class, DocumentFragment::class);
		$this->registerNodeClass(DOMDocumentType::class, DocumentType::class);
		$this->registerNodeClass(DOMCharacterData::class, CharacterData::class);
		$this->registerNodeClass(DOMText::class, Text::class);
		$this->registerNodeClass(DOMComment::class, Comment::class);

		if($document instanceof DOMDocument) {
			$node = $this->importNode($document->documentElement, true);
			$this->appendChild($node);

			return;
		}
	}

	protected function getRootDocument():DOMDocument {
		return $this;
	}

	public function __toString() {
		return $this->saveHTML();
	}
}