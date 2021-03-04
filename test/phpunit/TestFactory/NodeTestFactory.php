<?php
namespace Gt\Dom\Test\TestFactory;

use Gt\Dom\Document;
use Gt\Dom\Element;

class NodeTestFactory {
	public static function createNode(
		string $tagName,
		Document $document = null
	):Element {
		if(!$document) {
			$document = new Document();
		}

		return $document->createElement($tagName);
	}
}
