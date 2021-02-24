<?php
namespace Gt\Dom;

class XMLDocument extends Document {
	const EMPTY_DOCUMENT_STRING = "<?xml ?>";

	protected function __construct(string $xml = "") {
		parent::__construct();

		if(strlen($xml) === 0) {
			$xml = self::EMPTY_DOCUMENT_STRING;
		}

		$this->domDocument->loadXML($xml);
	}

	protected function __prop_get_contentType():string {
		return "text/xml";
	}
}
