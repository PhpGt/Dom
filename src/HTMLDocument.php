<?php
namespace Gt\Dom;

class HTMLDocument extends Document {
	const EMPTY_DOCUMENT_STRING = "<!doctype html><html></html>";

	protected function __construct(string $html = "") {
		parent::__construct();

		if(strlen($html) === 0) {
			$html = self::EMPTY_DOCUMENT_STRING;
		}

		$this->domDocument->loadHTML($html);

		if(!$this->domDocument->documentElement) {
			$this->domDocument->documentElement =
				$this->domDocument->createElement("html");
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
}
