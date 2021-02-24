<?php
namespace Gt\Dom;

class XMLDocument extends Document {
	protected function __construct(string $xml = "") {
		parent::__construct();
	}

	protected function __prop_get_contentType():string {
		return "text/xml";
	}
}
