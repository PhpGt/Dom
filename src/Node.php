<?php
namespace Gt\Dom;

use DOMNode;

class Node extends DOMNode {
	use NonDocumentTypeChildNode;
	use ChildNode;
	use ParentNode;
	use RegisteredNodeClass;
}
