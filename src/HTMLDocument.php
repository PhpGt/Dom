<?php
namespace Gt\Dom;

use Gt\Dom\HTMLElement\HTMLElement;

/**
 * @method HTMLElement createElement(string $tagName)
 */
class HTMLDocument extends Document {
	const EMPTY_DOCUMENT_STRING = "<!doctype html><html><head></head><body></body></html>";
	const W3_NAMESPACE = "http://www.w3.org/1999/xhtml";

	public function __construct(string $html = "") {
		parent::__construct();

		if(strlen($html) === 0) {
			$html = self::EMPTY_DOCUMENT_STRING;
		}

		$this->open();
		$html = preg_replace_callback(
			'/[\x{80}-\x{10FFFF}]/u',
			function($match) {
				return mb_convert_encoding(
					$match[0],
					"HTML-ENTITIES",
					"UTF-8"
				);
			},
			$html
		);
		$this->domDocument->loadHTML($html);

		if(!$this->domDocument->documentElement) {
			$html = $this->domDocument->createElement("html");
			$this->domDocument->appendChild($html);
		}

		if(!$this->domDocument->getElementsByTagName("head")->item(0)
		) {
			$head = $this->domDocument->createElement("head");
			$this->domDocument->documentElement->insertBefore(
				$head,
				$this->domDocument->documentElement->firstChild
			);
		}
		if(!$this->domDocument->getElementsByTagName("body")->item(0)
		) {
			$body = $this->domDocument->createElement("body");
			$this->domDocument->documentElement->appendChild($body);
		}
	}

	protected function __prop_get_contentType():string {
		return "text/html";
	}
}
