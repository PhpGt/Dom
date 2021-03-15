<?php
namespace Gt\Dom\Test\TestFactory;

use Gt\Dom\Facade\HTMLDocumentFactory;
use Gt\Dom\HTMLDocument;
use Gt\Dom\HTMLElement\HTMLElement;

class HTMLElementTestFactory {
	public static function create(
		string $tagName = "div",
		HTMLDocument $document = null
	):HTMLElement {
		if(!$document) {
			$document = HTMLDocumentFactory::create("<!doctype html>");
		}

		/** @var HTMLElement $htmlElement */
		$htmlElement = $document->createElement($tagName);
		return $htmlElement;
	}
}
