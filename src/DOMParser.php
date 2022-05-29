<?php
namespace Gt\Dom;

class DOMParser {
	public function __construct() {
	}

	public function parseFromString(
		string $content,
		string $mimeType,
	):HTMLDocument|XMLDocument {
		$class = match($mimeType) {
			"text/html" => HTMLDocument::class,
			"application/xml", "text/xml" => XMLDocument::class,
		};
		/** @var HTMLDocument|XMLDocument $object */
		$object = new $class($content);
		return $object;
	}
}
