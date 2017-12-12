<?php
namespace Gt\Dom;

use DOMDocumentType;

/**
 * Represents a Node containing a doctype.
 */
class DocumentType extends DOMDocumentType {
	use ChildNode;
}