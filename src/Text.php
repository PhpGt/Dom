<?php
namespace Gt\Dom;

use DOMText;
use ReturnTypeWillChange;

/**
 * Represents the textual content of Element or Attr.  If an element has no
 * markup within its content, it has a single child implementing Text that
 * contains the element's text.  However, if the element contains markup, it is
 * parsed into information items and Text nodes that form its children.
 *
 * New documents have a single Text node for each block of text. Over time,
 * more Text nodes may be created as the document's content changes.
 *
 * The Node.normalize() method merges adjacent Text objects back into a single
 * node for each block of text.
 */
class Text extends DOMText {
	/**
	 * @see http://php.net/manual/en/domtext.iswhitespaceinelementcontent.php
	 * @see https://developer.mozilla.org/en-US/docs/Web/API/Text/isElementContentWhitespace
	 */
	#[ReturnTypeWillChange]
	public function isElementContentWhitespace() {
		return $this->isWhitespaceInElementContent();
	}
}
