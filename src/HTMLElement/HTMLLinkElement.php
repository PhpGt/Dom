<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\DOMTokenList;

/**
 * The HTMLLinkElement interface represents reference information for external
 * resources and the relationship of those resources to a document and
 * vice-versa (corresponds to <link> element; not to be confused with <a>, which
 * is represented by HTMLAnchorElement). This object inherits all of the
 * properties and methods of the HTMLElement interface.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLinkElement
 *
 * @property string $as Is a DOMString representing the type of content being loaded by the HTML link.
 * @property bool $disabled Is a Boolean which represents whether the link is disabled; currently only used with style sheet links.
 * @property string $href Is a DOMString representing the URI for the target resource.
 * @property string $hreflang Is a DOMString representing the language code for the linked resource.
 * @property string $media Is a DOMString representing a list of one or more media formats to which the resource applies.
 * @property string $referrerPolicy Is a DOMString that reflects the referrerpolicy HTML attribute indicating which referrer to use.
 * @property string $rel Is a DOMString representing the forward relationship of the linked resource from the document to the resource.
 * @property-read DOMTokenList $relList Is a DOMTokenList that reflects the rel HTML attribute, as a list of tokens.
 * @property-read DOMSettableTokenList $sizes Is a DOMSettableTokenList that reflects the sizes HTML attribute, as a list of tokens.
 * @property-read StyleSheet $sheet Returns the StyleSheet object associated with the given element, or null if there is none.
 * @property string $type Is a DOMString representing the MIME type of the linked resource.
 */
class HTMLLinkElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLinkElement/as */
	protected function __prop_get_as():string {
		return $this->getAttribute("as") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLinkElement/as */
	protected function __prop_set_as(string $value):void {
		$this->setAttribute("as", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLinkElement/disabled */
	protected function __prop_get_disabled():bool {
		return $this->hasAttribute("disabled");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLinkElement/disabled */
	protected function __prop_set_disabled(bool $value):void {
		if($value) {
			$this->setAttribute("disabled", "");
		}
		else {
			$this->removeAttribute("disabled");
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLinkElement/href */
	protected function __prop_get_href():string {
		return $this->getAttribute("href") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLinkElement/href */
	protected function __prop_set_href(string $value):void {
		$this->setAttribute("href", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLinkElement/hreflang */
	protected function __prop_get_hreflang():string {
		return $this->getAttribute("hreflang") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLinkElement/hreflang */
	protected function __prop_set_hreflang(string $value):void {
		$this->setAttribute("hreflang", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLinkElement/media */
	protected function __prop_get_media():string {
		return $this->getAttribute("media") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLinkElement/media */
	protected function __prop_set_media(string $value):void {
		$this->setAttribute("media", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLinkElement/referrerPolicy */
	protected function __prop_get_referrerPolicy():string {
		return $this->getAttribute("referrerpolicy") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLinkElement/referrerPolicy */
	protected function __prop_set_referrerPolicy(string $value):void {
		$this->setAttribute("referrerpolicy", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLinkElement/rel */
	protected function __prop_get_rel():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLinkElement/rel */
	protected function __prop_set_rel(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLinkElement/relList */
	protected function __prop_get_relList():DOMTokenList {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLinkElement/sizes */
	protected function __prop_get_sizes():DOMSettableTokenList {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLinkElement/sheet */
	protected function __prop_get_sheet():StyleSheet {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLinkElement/type */
	protected function __prop_get_type():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLinkElement/type */
	protected function __prop_set_type(string $value):void {

	}
}
