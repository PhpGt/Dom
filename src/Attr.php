<?php
namespace Gt\Dom;

/**
 * Represents an attribute on an Element object.
 *
 * In most DOM methods, you will probably directly retrieve the attribute as a
 * string (e.g., Element::getAttribute()), but certain functions (e.g.,
 * Element::getAttributeNode()) or means of iterating give Attr types.
 */
class Attr extends \DOMAttr {}#