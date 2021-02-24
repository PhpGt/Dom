<?php
namespace Gt\Dom;

use Gt\Dom\Exception\MimeTypeNotSupportedException;

class DOMParser {
	const MIME_TYPE_CLASS = [
		"text/html" => HTMLDocument::class,
		"text/xml" => XMLDocument::class,
		"application/xml" => XMLDocument::class,
		"application/xhtml+xml" => XMLDocument::class,
		"image/svg+xml" => XMLDocument::class,
	];

	public function __construct() {

	}

	public function parseFromString(
		string $string,
		string $mimeType
	):Document {
		$this->checkMimeType($mimeType);
	}

	private function checkMimeType(string $mimeType):void {
		$mimeType = strtolower($mimeType);
		if(!array_key_exists($mimeType, self::MIME_TYPE_CLASS)) {
			throw new MimeTypeNotSupportedException($mimeType);
		}
	}
}
