<?php
namespace Gt\Dom\Test\TestFactory;

use Gt\Dom\Document;
use Gt\Dom\DocumentFragment;
use Gt\Dom\Element;
use Gt\Dom\Facade\HTMLDocumentFactory;
use Gt\Dom\HTMLDocument;
use Gt\Dom\HTMLElement\HTMLElement;

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

	public static function createHTMLElement(
		string $tagName,
		HTMLDocument $document = null
	):HTMLElement {
		if(!$document) {
			$document = HTMLDocumentFactory::create("");
		}

		return $document->createElement($tagName);
	}

	public static function createFragment(
		HTMLDocument $document = null
	):DocumentFragment {
		if(!$document) {
			$document = HTMLDocumentFactory::create("");
		}

		return $document->createDocumentFragment();
	}

	public static function createTextNode(
		string $content = "",
		HTMLDocument $document = null
	) {
		if(!$document) {
			$document = HTMLDocumentFactory::create("");
		}

		return $document->createTextNode($content);
	}
}
