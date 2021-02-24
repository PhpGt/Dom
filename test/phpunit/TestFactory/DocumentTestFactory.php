<?php
namespace Gt\Dom\Test\TestFactory;

use Gt\Dom\DOMParser;
use Gt\Dom\HTMLDocument;

class DocumentTestFactory {
	const HTML_DEFAULT = <<<HTML
	<!doctype html>
	<h1>Hello, PHP.Gt!</h1>
	HTML;

	public static function createHTMLDocument(string $html):HTMLDocument {
		$parser = new DOMParser();
		return $parser->parseFromString($html, "text/html");
	}
}
