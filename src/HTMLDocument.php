<?php
namespace Gt\Dom;

use Gt\PropFunc\MagicProp;

/**
 * @property-read ?Element $body
 * @property-read ?Element $head
 * @property-read HTMLCollection $embeds
 *
// * @method getElementsByTagName(string $tagName)
 */
class HTMLDocument extends Document {
	use MagicProp;

	public function __construct(
		string $html = "<!doctype html>",
		string $characterSet = "UTF-8"
	) {
		parent::__construct(
			$characterSet,
			"text/html",
		);

		$html = mb_convert_encoding(
			$html,
			"HTML-ENTITIES",
			$this->characterSet,
		);
		$this->loadHTML($html);

		if(is_null($this->documentElement)) {
			$this->appendChild($this->createElement("html"));
		}
	}

	public function __toString():string {
		$documentElement = $this->documentElement;
		if(is_null($documentElement)) {
			$documentElement = $this->createElement("html");
			$this->appendChild($documentElement);
		}
		if(is_null($this->head)) {
			$documentElement->prepend($this->createElement("head"));
		}
		if(is_null($this->body)) {
			$documentElement->append($this->createElement("body"));
		}
		return parent::__toString();
	}

	public function __prop_get_body():Element {
		$body = $this->getElementsByTagName("body")->item(0);
		if(is_null($body)) {
			$body = $this->createElement("body");
			$this->documentElement->append($body);
		}

		return $body;
	}

	public function __prop_get_head():Element {
		$head = $this->getElementsByTagName("head")->item(0);
		if(is_null($head)) {
			$head = $this->createElement("head");
			$this->documentElement->prepend($head);
		}

		return $head;
	}

	public function __prop_get_embeds():HTMLCollection {
		return $this->getElementsByTagName("embed");
	}
}
