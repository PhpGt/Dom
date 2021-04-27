<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\DocumentFragment;

/**
 * The HTMLTemplateElement interface enables access to the contents of an HTML
 * <template> element.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTemplateElement
 *
 * @property-read DocumentFragment $content
 */
class HTMLTemplateElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTemplateElement/content */
	protected function __prop_get_content():DocumentFragment {
		$fragment = $this->ownerDocument->createDocumentFragment();
		foreach($this->childNodes as $childNode) {
			$fragment->appendChild($childNode->cloneNode(true));
		}

		return $fragment;
	}
}
