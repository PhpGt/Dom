<?php
namespace Gt\Dom\Test;

use Gt\Dom\Attr;
use Gt\Dom\Comment;
use Gt\Dom\Document;
use Gt\Dom\DocumentFragment;
use Gt\Dom\DocumentType;
use Gt\Dom\Element;
use Gt\Dom\Facade\TreeWalkerFactory;
use Gt\Dom\HTMLElement\HTMLBodyElement;
use Gt\Dom\HTMLElement\HTMLHeadingElement;
use Gt\Dom\HTMLElement\HTMLImageElement;
use Gt\Dom\HTMLElement\HTMLLiElement;
use Gt\Dom\HTMLElement\HTMLUListElement;
use Gt\Dom\Node;
use Gt\Dom\NodeFilter;
use Gt\Dom\ProcessingInstruction;
use Gt\Dom\Test\TestFactory\DocumentTestFactory;
use Gt\Dom\Test\TestFactory\NodeTestFactory;
use Gt\Dom\Text;
use PHPUnit\Framework\TestCase;

class TreeWalkerTest extends TestCase {
	public function testRoot():void {
		$root = self::createMock(Node::class);
		$sut = TreeWalkerFactory::create($root);
		self::assertSame($root, $sut->root);
	}

	public function testWhatToShow():void {
		$whatToShow = NodeFilter::SHOW_DOCUMENT_FRAGMENT;
		$sut = TreeWalkerFactory::create(
			self::createMock(Node::class),
			$whatToShow
		);
		self::assertSame($whatToShow, $sut->whatToShow);
	}

	public function testFilterFromCallable():void {
		$callCount = 0;
		$callable = function(Node $node) use(&$callCount) {
			$callCount++;
			return $callCount;
		};
		$root = self::createMock(Node::class);
		$sut = TreeWalkerFactory::create(
			$root,
			NodeFilter::SHOW_ALL,
			$callable
		);
		$nodeFilter = $sut->filter;
		$accept = $nodeFilter->acceptNode($root);
		self::assertEquals(1, $callCount);
		self::assertEquals(1, $accept);
	}

	public function testParentNode():void {
		$root = NodeTestFactory::createNode("root");
		$sut = TreeWalkerFactory::create($root);
		self::assertNull($sut->parentNode());
		self::assertSame($root, $sut->currentNode);
	}

	public function testParentNodeDeep():void {
		$root = NodeTestFactory::createNode("root");
		$trunk = $root->ownerDocument->createElement("trunk");
		$branch = $root->ownerDocument->createElement("branch");
		$leaf1 = $root->ownerDocument->createElement("leaf");
		$leaf2 = $root->ownerDocument->createElement("leaf");
		$leaf3 = $root->ownerDocument->createElement("leaf");
		$root->appendChild($trunk);
		$trunk->appendChild($branch);
		$branch->append($leaf1, $leaf2, $leaf3);
		$sut = $root->ownerDocument->createTreeWalker($root);
		while($node = $sut->nextNode()) {}
		self::assertSame($branch, $sut->parentNode());
		self::assertSame($trunk, $sut->parentNode());
		self::assertSame($root, $sut->parentNode());
		self::assertNull($sut->parentNode());
	}

	public function testFirstChildNone():void {
		$root = NodeTestFactory::createNode("root");
		$sut = TreeWalkerFactory::create($root);
		self::assertNull($sut->firstChild());
		self::assertSame($root, $sut->currentNode);
	}

	public function testFirstChild():void {
		$root = NodeTestFactory::createNode("root");
		$child1 = $root->ownerDocument->createElement("child");
		$child2 = $root->ownerDocument->createElement("child");
		$child3 = $root->ownerDocument->createElement("child");
		$root->append($child1, $child2, $child3);
		$sut = TreeWalkerFactory::create($root);
		self::assertSame($child1, $sut->firstChild());
		self::assertSame($child1, $sut->currentNode);
	}

	public function testLastChildNone():void {
		$root = NodeTestFactory::createNode("root");
		$sut = TreeWalkerFactory::create($root);
		self::assertNull($sut->lastChild());
		self::assertSame($root, $sut->currentNode);
	}

	public function testLastChild():void {
		$root = NodeTestFactory::createNode("root");
		$child1 = $root->ownerDocument->createElement("child");
		$child2 = $root->ownerDocument->createElement("child");
		$child3 = $root->ownerDocument->createElement("child");
		$root->append($child1, $child2, $child3);
		$sut = TreeWalkerFactory::create($root);
		self::assertSame($child3, $sut->lastChild());
		self::assertSame($child3, $sut->currentNode);
	}

	public function testPreviousSiblingNone():void {
		$root = NodeTestFactory::createNode("root");
		$root->ownerDocument->appendChild($root);
		$sut = TreeWalkerFactory::create($root);
		self::assertNull($sut->previousSibling());
		self::assertSame($root, $sut->currentNode);
	}

	public function testPreviousSibling():void {
		$root = NodeTestFactory::createNode("root");
		$root->ownerDocument->appendChild($root);
		$other1 = $root->ownerDocument->createElement("other");
		$other2 = $root->ownerDocument->createElement("other");
		$other3 = $root->ownerDocument->createElement("other");
		$root->append($other1, $other2, $other3);
		$sut = TreeWalkerFactory::create($root);
		$sut->nextNode();
		$sut->nextNode();
		self::assertSame($other1, $sut->previousSibling());
		self::assertSame($other1, $sut->currentNode);
	}

	public function testNextSiblingNone():void {
		$root = NodeTestFactory::createNode("root");
		$root->ownerDocument->appendChild($root);
		$sut = TreeWalkerFactory::create($root);
		self::assertNull($sut->nextSibling());
		self::assertSame($root, $sut->currentNode);
	}

	public function testNextSibling():void {
		$root = NodeTestFactory::createNode("root");
		$root->ownerDocument->appendChild($root);
		$other1 = $root->ownerDocument->createElement("other");
		$other2 = $root->ownerDocument->createElement("other");
		$other3 = $root->ownerDocument->createElement("other");
		$root->append($other1, $other2, $other3);
		$sut = TreeWalkerFactory::create($root);
		$sut->nextNode();
		$sut->nextNode();
		self::assertSame($other3, $sut->nextSibling());
		self::assertSame($other3, $sut->currentNode);
	}

	public function testPreviousNodeNone():void {
		$root = NodeTestFactory::createNode("root");
		$sut = TreeWalkerFactory::create($root);
		self::assertNull($sut->previousNode());
		self::assertSame($root, $sut->currentNode);
	}

	public function testPreviousNodeDeep():void {
		$root = NodeTestFactory::createNode("root");
		$sibling = $root->ownerDocument->createElement("sibling");
		$trunk = $root->ownerDocument->createElement("trunk");
		$branch = $root->ownerDocument->createElement("branch");
		$leaf1 = $root->ownerDocument->createElement("leaf");
		$leaf2 = $root->ownerDocument->createElement("leaf");
		$leaf3 = $root->ownerDocument->createElement("leaf");
		$docRoot = $root->ownerDocument->createElement("doc-root");
		$root->ownerDocument->appendChild($docRoot);
		$docRoot->appendChild($sibling);
		$docRoot->appendChild($root);
		$root->appendChild($trunk);
		$trunk->appendChild($branch);
		$branch->append($leaf1, $leaf2, $leaf3);
		$sut = $root->ownerDocument->createTreeWalker($root);
		while($node = $sut->nextNode()) {}
		self::assertSame($leaf3, $sut->currentNode);
		self::assertSame($leaf2, $sut->previousNode());
		self::assertSame($leaf1, $sut->previousNode());
		self::assertSame($branch, $sut->previousNode());
		self::assertSame($trunk, $sut->previousNode());
		self::assertSame($root, $sut->previousNode());
		self::assertNull($sut->previousNode());
	}

	public function testPreviousNode():void {
		$root = NodeTestFactory::createNode("root");
		$root->ownerDocument->appendChild($root);
		$other1 = $root->ownerDocument->createElement("other");
		$other2 = $root->ownerDocument->createElement("other");
		$other3 = $root->ownerDocument->createElement("other");
		$root->append($other1, $other2, $other3);
		$sut = TreeWalkerFactory::create($root);
		$sut->nextNode();
		$sut->nextNode();
		$sut->nextNode();
		self::assertSame($other2, $sut->previousNode());
		self::assertSame($other1, $sut->previousNode());
		self::assertSame($root, $sut->previousNode());
		self::assertNull($sut->previousNode());
		self::assertSame($root, $sut->currentNode);
	}

	public function testNextNodeNode():void {
		$root = NodeTestFactory::createNode("root");
		$sut = TreeWalkerFactory::create($root);
		self::assertNull($sut->nextNode());
		self::assertSame($root, $sut->currentNode);
	}

	public function testNextNode():void {
		$root = NodeTestFactory::createNode("root");
		$root->ownerDocument->appendChild($root);
		$other1 = $root->ownerDocument->createElement("other");
		$other2 = $root->ownerDocument->createElement("other");
		$other3 = $root->ownerDocument->createElement("other");
		$root->append($other1, $other2, $other3);
		$sut = TreeWalkerFactory::create($root);
		self::assertSame($other1, $sut->nextNode());
		self::assertSame($other2, $sut->nextNode());
		self::assertSame($other3, $sut->nextNode());
		self::assertNull($sut->nextNode());
		self::assertSame($other3, $sut->currentNode);
	}

	public function testIteration():void {
		$document = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_IMAGES);
		$sut = TreeWalkerFactory::create($document->body);
		$collectedNodes = [];
		foreach($sut as $node) {
			array_push($collectedNodes, $node);
		}

		self::assertSame($collectedNodes[2], $document->querySelector("h1"));
		self::assertSame("Take a look at these amazing photos!", $collectedNodes[3]->textContent);
	}

	public function testIteratorWhatToShow():void {
		$document = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_IMAGES);
		$sut = TreeWalkerFactory::create(
			$document->body,
			NodeFilter::SHOW_ELEMENT,
		);
		$collectedNodes = [];
		foreach($sut as $i => $node) {
			array_push($collectedNodes, $node);
		}

		self::assertInstanceOf(HTMLBodyElement::class, $collectedNodes[0]);
		self::assertInstanceOf(HTMLHeadingElement::class, $collectedNodes[1]);
		self::assertInstanceOf(HTMLUListElement::class, $collectedNodes[2]);
		self::assertInstanceOf(HTMLLiElement::class, $collectedNodes[3]);
		self::assertInstanceOf(HTMLImageElement::class, $collectedNodes[4]);
		self::assertInstanceOf(HTMLLiElement::class, $collectedNodes[5]);
		self::assertInstanceOf(HTMLImageElement::class, $collectedNodes[6]);
		self::assertInstanceOf(HTMLLiElement::class, $collectedNodes[7]);
		self::assertInstanceOf(HTMLImageElement::class, $collectedNodes[8]);
		self::assertInstanceOf(HTMLLiElement::class, $collectedNodes[9]);
		self::assertInstanceOf(HTMLImageElement::class, $collectedNodes[10]);
	}

	public function testPreviousNodeWhatToShow():void {
		$document = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_IMAGES);
		$sut = TreeWalkerFactory::create(
			$document->body,
			NodeFilter::SHOW_ELEMENT,
		);
		while($sut->nextNode()){}

		self::assertInstanceOf(HTMLImageElement::class, $sut->currentNode);
		self::assertInstanceOf(HTMLLiElement::class, $sut->previousNode());
		self::assertInstanceOf(HTMLImageElement::class, $sut->previousNode());
		self::assertInstanceOf(HTMLLiElement::class, $sut->previousNode());
		self::assertInstanceOf(HTMLImageElement::class, $sut->previousNode());
		self::assertInstanceOf(HTMLLiElement::class, $sut->previousNode());
		self::assertInstanceOf(HTMLImageElement::class, $sut->previousNode());
		self::assertInstanceOf(HTMLLiElement::class, $sut->previousNode());
		self::assertInstanceOf(HTMLUListElement::class, $sut->previousNode());
		self::assertInstanceOf(HTMLHeadingElement::class, $sut->previousNode());
		self::assertInstanceOf(HTMLBodyElement::class, $sut->previousNode());
		self::assertNull($sut->previousNode());
	}

	public function testIterateOverTextNodesOnly():void {
		$document = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_PAGE);
		$sut = TreeWalkerFactory::create(
			$document->body,
			NodeFilter::SHOW_TEXT
		);
		foreach($sut as $i => $node) {
			if($i === 0) {
				self::assertSame($document->body, $node);
			}
			else {
				self::assertInstanceOf(Text::class, $node);
			}
		}
	}

	public function testAttribute():void {
		$document = DocumentTestFactory::createHTMLDocument();
		$sut = TreeWalkerFactory::create(
			$document->documentElement,
			NodeFilter::SHOW_ATTRIBUTE
		);
		$attr = self::createMock(Attr::class);
		$element = self::createMock(Element::class);
		self::assertEquals(NodeFilter::FILTER_ACCEPT, $sut->filter->acceptNode($attr));
		self::assertEquals(NodeFilter::FILTER_REJECT, $sut->filter->acceptNode($element));
	}

	public function testProcessingInstruction():void {
		$document = DocumentTestFactory::createHTMLDocument();
		$sut = TreeWalkerFactory::create(
			$document->documentElement,
			NodeFilter::SHOW_PROCESSING_INSTRUCTION
		);
		$pin = self::createMock(ProcessingInstruction::class);
		$element = self::createMock(Element::class);
		self::assertEquals(NodeFilter::FILTER_ACCEPT, $sut->filter->acceptNode($pin));
		self::assertEquals(NodeFilter::FILTER_REJECT, $sut->filter->acceptNode($element));
	}

	public function testComment():void {
		$document = DocumentTestFactory::createHTMLDocument();
		$sut = TreeWalkerFactory::create(
			$document->documentElement,
			NodeFilter::SHOW_COMMENT
		);
		$comment = self::createMock(Comment::class);
		$element = self::createMock(Element::class);
		self::assertEquals(NodeFilter::FILTER_ACCEPT, $sut->filter->acceptNode($comment));
		self::assertEquals(NodeFilter::FILTER_REJECT, $sut->filter->acceptNode($element));
	}

	public function testDocument():void {
		$document = DocumentTestFactory::createHTMLDocument();
		$sut = TreeWalkerFactory::create(
			$document->documentElement,
			NodeFilter::SHOW_DOCUMENT
		);
		$doc = self::createMock(Document::class);
		$element = self::createMock(Element::class);
		self::assertEquals(NodeFilter::FILTER_ACCEPT, $sut->filter->acceptNode($doc));
		self::assertEquals(NodeFilter::FILTER_REJECT, $sut->filter->acceptNode($element));
	}

	public function testDocType():void {
		$document = DocumentTestFactory::createHTMLDocument();
		$sut = TreeWalkerFactory::create(
			$document->documentElement,
			NodeFilter::SHOW_DOCUMENT_TYPE
		);
		$docType = self::createMock(DocumentType::class);
		$element = self::createMock(Element::class);
		self::assertEquals(NodeFilter::FILTER_ACCEPT, $sut->filter->acceptNode($docType));
		self::assertEquals(NodeFilter::FILTER_REJECT, $sut->filter->acceptNode($element));
	}

	public function testDocFragment():void {
		$document = DocumentTestFactory::createHTMLDocument();
		$sut = TreeWalkerFactory::create(
			$document->documentElement,
			NodeFilter::SHOW_DOCUMENT_FRAGMENT
		);
		$fragment = self::createMock(DocumentFragment::class);
		$element = self::createMock(Element::class);
		self::assertEquals(NodeFilter::FILTER_ACCEPT, $sut->filter->acceptNode($fragment));
		self::assertEquals(NodeFilter::FILTER_REJECT, $sut->filter->acceptNode($element));
	}

	public function testCommentOrAttribute():void {
		$document = DocumentTestFactory::createHTMLDocument();
		$sut = TreeWalkerFactory::create(
			$document->documentElement,
			NodeFilter::SHOW_COMMENT | NodeFilter::SHOW_ATTRIBUTE
		);
		$comment = self::createMock(Comment::class);
		$attribute = self::createMock(Attr::class);
		$element = self::createMock(Element::class);
		self::assertEquals(NodeFilter::FILTER_ACCEPT, $sut->filter->acceptNode($comment));
		self::assertEquals(NodeFilter::FILTER_REJECT, $sut->filter->acceptNode($element));
		self::assertEquals(NodeFilter::FILTER_ACCEPT, $sut->filter->acceptNode($attribute));
	}

	public function testFirstChildFilter():void {
		$document = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_COMMENT);
		$sut = TreeWalkerFactory::create(
			$document->body,
			NodeFilter::SHOW_COMMENT
		);
		$firstChild = $sut->firstChild();
		self::assertInstanceOf(Comment::class, $firstChild);
	}

	public function testFirstChildSkip():void {
		$document = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_COMMENT);
		$sut = TreeWalkerFactory::create(
			$document->body,
			NodeFilter::SHOW_ELEMENT,
// Skip heading elements (of which there are two, surrounding the comment).
			new class extends NodeFilter {
				public function acceptNode(Node $node):int {
					if($node instanceof HTMLHeadingElement) {
						return NodeFilter::FILTER_SKIP;
					}
					if($node instanceof Comment) {
						return NodeFilter::FILTER_ACCEPT;
					}

					return NodeFilter::FILTER_REJECT;
				}
			}
		);
		$firstChild = $sut->firstChild();
		self::assertInstanceOf(Comment::class, $firstChild);
	}
}
