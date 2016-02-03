<?php
namespace phpgt\dom;

/**
 * Contains methods that are particular to Node objects that can have children.
 *
 * This trait can only be used in a class that is a trait of LivePropertyGetter.
 *
 * This trait is used by the following classes:
 *  - Element
 *  - Document
 *  - DocumentFragment
 */
trait ParentNode {

private function prop_children():HTMLCollection {
	return new HTMLCollection($this->childNodes);
}

private function prop_firstElementChild() {
	return $this->children->item(0);
}

private function prop_lastElementChild() {
	return $this->children->item($this->children->length - 1);
}

private function prop_childElementCount() {
	return $this->children->length;
}

}#