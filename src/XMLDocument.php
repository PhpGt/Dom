<?php
namespace Gt\Dom;

use DOMDocument;

/**
 * Provides access to special properties and methods not present by default
 * on a regular document.
 */
class XMLDocument extends Document {
	use LiveProperty, ParentNode;

	public function __construct($document) {
		parent::__construct($document);

		if(!$document instanceof DOMDocument) {
			$this->loadXML($document);
		}
	}
}