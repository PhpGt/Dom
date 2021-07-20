<?php
namespace Gt\Dom;

use Gt\Dom\Exception\MimeTypeNotSupportedException;
use Gt\Dom\Facade\HTMLDocumentFactory;
use Gt\Dom\Facade\XMLDocumentFactory;

class DOMParser {
	const MIME_TYPE_CLASS = [
		"text/html" => HTMLDocument::class,
		"text/xml" => XMLDocument::class,
		"application/xml" => XMLDocument::class,
		"application/xhtml+xml" => XMLDocument::class,
		"image/svg+xml" => XMLDocument::class,
	];

	const FACTORY_CLASS = [
		HTMLDocument::class => HTMLDocumentFactory::class,
		XMLDocument::class => XMLDocumentFactory::class,
	];

	public function __construct() {

	}

	public function parseFromString(
		string $string,
		string $mimeType
	):HTMLDocument|XMLDocument {
		$mimeType = strtolower($mimeType);
		$this->checkMimeType($mimeType);
		$documentClass = self::MIME_TYPE_CLASS[$mimeType];
		$factoryClass = self::FACTORY_CLASS[$documentClass];
		return call_user_func(
			"$factoryClass::create",
			$string
		);
	}

	private function checkMimeType(string $mimeType):void {
		if(!array_key_exists($mimeType, self::MIME_TYPE_CLASS)) {
			throw new MimeTypeNotSupportedException($mimeType);
		}
	}
}
