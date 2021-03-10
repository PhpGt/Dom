<?php
namespace Gt\Dom;

use Gt\Dom\Facade\Traversal;
use Iterator;

/**
 * The TreeWalker object represents the nodes of a document subtree and a
 * position within them.
 *
 * A TreeWalker can be created using the Document.createTreeWalker() method.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/TreeWalker
 *
 * @property-read Node $pRoot Returns a Node representing the root node as specified when the TreeWalker was created.
 * @property-read int $pWhatToShow Returns an unsigned long being a bitmask made  of constants describing the types of Node that must be presented. Non-matching nodes are skipped, but their children may be included, if relevant. The possible values are NodeFilter.SHOW_* constants.
 * @property-read NodeFilter $filter Returns a NodeFilter used to select the relevant nodes.
 * @property-read Node $currentNode Is the Node on which the TreeWalker is currently pointing at.
 *
 * @implements Iterator<Node>
 *
 * Many thanks to Timo Tijhof for their dom-TreeWalker-polyfill project which
 * helped as reference while implementing this functionality:
 * https://github.com/Krinkle/dom-TreeWalker-polyfill
 *
 * TODO: Currently there is no difference between a TreeWalker and a NodeIterator.
 * What is the difference? I need some help in understanding.
 */
class TreeWalker implements Iterator {
	use Traversal;
}
