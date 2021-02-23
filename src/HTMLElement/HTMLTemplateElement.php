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
	protected function __prop_get_content():DocumentFragment {

	}
}
