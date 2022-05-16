<?php
namespace Gt\Dom;

use Gt\PropFunc\MagicProp;

/**
 * @property-read ?Element $body The Document.body property represents the <body> or <frameset> node of the current document, or null if no such element exists.
 * @property-read ?Element $head Returns the <head> element of the current document.
 * @property-read HTMLCollection $embeds Returns a list of the embedded <embed> elements within the current document.
 * @property-read HTMLCollection $forms Returns a list of the <form> elements within the current document.
 * @property-read HTMLCollection $images Returns a list of the images in the current document.
 * @property-read HTMLCollection $links Returns a list of all the hyperlinks in the document.
 * @property-read HTMLCollection $scripts Returns all the script elements on the document.
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
		if(is_null($this->head)) {
			$this->documentElement->prepend($this->createElement("head"));
		}
		if(is_null($this->body)) {
			$this->documentElement->append($this->createElement("body"));
		}
	}

	public function __toString():string {
		$documentElement = $this->documentElement;
		if(is_null($documentElement)) {
			$documentElement = $this->createElement("html");
			$this->appendChild($documentElement);
		}

		return parent::__toString();
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Document/body */
	public function __prop_get_body():null|Element {
		$body = $this->getElementsByTagName("body")->item(0);
		if(is_null($body)) {
			$body = $this->createElement("body");
			$this->documentElement->append($body);
		}

		return $body;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Document/head */
	public function __prop_get_head():null|Element {
		$head = $this->getElementsByTagName("head")->item(0);
//		if(is_null($head)) {
//			$head = $this->createElement("head");
//			$this->documentElement->prepend($head);
//		}

		return $head;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Document/embeds */
	public function __prop_get_embeds():HTMLCollection {
		return $this->getElementsByTagName("embed");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Document/forms */
	public function __prop_get_forms():HTMLCollection {
		return $this->getElementsByTagName("form");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Document/images */
	public function __prop_get_images():HTMLCollection {
		return $this->getElementsByTagName("img");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Document/links */
	public function __prop_get_links():HTMLCollection {
		return HTMLCollectionFactory::create(function() {
			$elementList = [];

			$areaList = $this->getElementsByTagName("area");
			for($i = 0, $len = $areaList->length; $i < $len; $i++) {
				array_push($elementList, $areaList->item($i));
			}
			$aList = $this->getElementsByTagName("a");
			for($i = 0, $len = $aList->length; $i < $len; $i++) {
				$domNode = $aList->item($i);
				$hrefAttr = $domNode->attributes->getNamedItem(
					"href"
				);
				if(!$hrefAttr) {
					continue;
				}
				array_push($elementList, $domNode);
			}

			return NodeListFactory::create(...$elementList);
		});
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Document/scripts */
	public function __prop_get_scripts():HTMLCollection {
		return $this->getElementsByTagName("script");
	}
}
