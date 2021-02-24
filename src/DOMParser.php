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
		$mimeType = strtolower($mimeType);
		$this->checkMimeType($mimeType);
		$documentClass = self::MIME_TYPE_CLASS[$mimeType];
		$document = new $documentClass();
		return $document;
	}

	private function checkMimeType(string $mimeType):void {
		if(!array_key_exists($mimeType, self::MIME_TYPE_CLASS)) {
			throw new MimeTypeNotSupportedException($mimeType);
		}
	}
}
