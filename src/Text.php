<?php
namespace phpgt\dom;

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
class Text extends \DOMText {}#