<?php
namespace Gt\Dom;

/**
 * The DocumentFragment interface represents a minimal document object that has
 * no parent. It is used as a lightweight version of Document that stores a
 * segment of a document structure comprised of nodes just like a standard
 * document. The key difference is due to the fact that the document fragment
 * isn't part of the active document tree structure. Changes made to the
 * fragment don't affect the document (even on reflow) or incur any performance
 * impact when changes are made.
 */
class DocumentFragment extends Node {
	use ParentNode;

	/**
	 * Returns the first Element node within the DocumentFragment, in
	 * document order, that matches the specified ID. Functionally
	 * equivalent to Document.getElementById().
	 *
	 * @param string $id
	 * @return ?Element
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/DocumentFragment/getElementById
	 */
	public function getElementById(string $id):?Element {

	}
}
