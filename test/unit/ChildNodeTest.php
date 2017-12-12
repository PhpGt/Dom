<?php
namespace Gt\Dom\Test;

use Gt\Dom\HTMLDocument;
use Gt\Dom\Test\Helper\Helper;
use PHPUnit\Framework\TestCase;

class ChildNodeTest extends TestCase {
	public function testBefore() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$element = $document->getElementById("who");
		$currentBefore = $element->previousSibling;

		$newElement = $document->createElement("div");
		$element->before($newElement);

		$this->assertSame($newElement, $element->previousSibling);
		$this->assertSame($newElement, $currentBefore->nextSibling);
	}

	public function testAfter() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$element = $document->getElementById("who");
		$currentAfter = $element->nextSibling;

		$newElement = $document->createElement("div");
		$element->after($newElement);

		$this->assertSame($newElement, $element->nextSibling);
		$this->assertSame($newElement, $currentAfter->previousSibling);
	}

	public function testReplaceWith() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$element = $document->getElementById("who");
		$currentBefore = $element->previousSibling;

		$newElement = $document->createElement("div");
		$element->replaceWith($newElement);

		$this->assertSame($newElement, $currentBefore->nextSibling);
	}

	public function testReplaceWithInSameDocument() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$h2 = $document->getElementById("who");
		$beforeH2 = $h2->previousSibling;
		$h1 = $document->firstChild;

		$h2->replaceWith($h1);
		$this->assertSame($h1, $beforeH2->nextSibling);
		$this->assertNotSame($h1, $document->firstChild);
	}

	/**
	 * @see https://github.com/PhpGt/Dom/wiki/Classes-that-make-up-DOM#childnode
	 */
	public function testDocsReplaceWith() {
		$document = new HTMLDocument(Helper::DOCS_CHILDNODE_REPLACEWITH);
		// Create a fake POST array to keep test as similar to docs as possible.
		$_POST = $_POST ?? [];

		foreach(["A", "B", "C"] as $order) {
			$_POST["order"] = $order;
			$form = $document->forms[0];
			$firstButton = $form->firstElementChild;
			$clickedButton = $form->querySelector("[value='" . $_POST["order"] . "']");

			if($firstButton !== $clickedButton) {
				// Move clicked button before first button.
				$firstButton->before($clickedButton);
			}

			$this->assertSame($clickedButton, $form->firstElementChild);
			$this->assertCount(3, $form->children);
		}
	}
}