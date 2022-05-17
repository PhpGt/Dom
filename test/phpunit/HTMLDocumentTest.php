<?php /** @noinspection HtmlRequiredTitleElement */
namespace Gt\Dom\Test;

use Gt\Dom\Attr;
use Gt\Dom\Comment;
use Gt\Dom\DocumentFragment;
use Gt\Dom\DocumentType;
use Gt\Dom\Element;
use Gt\Dom\ElementType;
use Gt\Dom\Exception\DocumentHasMoreThanOneElementChildException;
use Gt\Dom\Exception\DocumentStreamNotWritableException;
use Gt\Dom\Exception\HTMLDocumentDoesNotSupportCDATASectionException;
use Gt\Dom\Exception\InvalidCharacterException;
use Gt\Dom\Exception\TextNodeCanNotBeRootNodeException;
use Gt\Dom\Exception\WrongDocumentErrorException;
use Gt\Dom\Exception\XPathQueryException;
use Gt\Dom\HTMLCollection;
use Gt\Dom\Test\TestFactory\DocumentTestFactory;
use Gt\PropFunc\PropertyReadOnlyException;
use PHPUnit\Framework\TestCase;
use Gt\Dom\HTMLDocument;
use Throwable;

class HTMLDocumentTest extends TestCase {
	public function testConstructor():void {
		$exception = null;

		try {
			new HTMLDocument();
		}
		catch(Throwable $exception) {}

		self::assertNull($exception);
	}

	public function testConstructor_createsRootNode():void {
		$sut = new HTMLDocument("<h1>Test</h1>");
		self::assertEquals(
			"html",
			$sut->documentElement->tagName
		);
	}

	public function testConstructor_createsBody():void {
		$sut = new HTMLDocument("<!<!doctype html><head></head>");
		self::assertInstanceOf(Element::class, $sut->body);
	}

	public function testAppendChild_createdElementsAreNotNamespaced():void {
		$sut = new HTMLDocument('<html lang="en"><head><title>Test</title></head><body></body></html>');
		$div = $sut->createElement("div");
		$sut->body->appendChild($div);
		self::assertEquals(
			"<div></div>",
			$sut->body->innerHTML
		);
	}

	public function testToString_emojiEncoding():void {
		$html = "<h1>I ❤️ my 🐈</h1>";
		$sut = new HTMLDocument($html);
		self::assertStringContainsString("$html", (string)$sut);
	}

	public function testPropBody_readOnly():void {
		$sut = new HTMLDocument();
		$property = "body";
		self::expectException(PropertyReadOnlyException::class);
		/** @phpstan-ignore-next-line */
		$sut->$property = "can-not-set";
	}

	public function testPropBody_instanceOfHTMLBodyElementEmptyHTML():void {
		$sut = new HTMLDocument();
		self::assertEquals(ElementType::HTMLBodyElement, $sut->body->elementType);
	}

	public function testPropBody_instanceOfHTMLBodyElementDefaultHTML():void {
		$sut = new HTMLDocument(DocumentTestFactory::HTML_DEFAULT);
		self::assertEquals(ElementType::HTMLBodyElement, $sut->body->elementType);
	}

	public function testToString_emptyHTML():void {
		$sut = new HTMLDocument();
		/** @noinspection HtmlRequiredLangAttribute */
		self::assertEquals("<!DOCTYPE html>\n<html><head></head><body></body></html>\n", (string)$sut);
	}

	public function testToStringDefaultHTML():void {
		$sut = new HTMLDocument(DocumentTestFactory::HTML_DEFAULT);
		/** @noinspection HtmlRequiredLangAttribute */
		self::assertEquals("<!DOCTYPE html>\n<html><head></head><body><h1>Hello, PHP.Gt!</h1></body></html>\n", (string)$sut);
	}

	public function testPropCharacter_default():void {
		$sut = new HTMLDocument();
		self::assertEquals("UTF-8", $sut->characterSet);
	}

	public function testPropCharacter_html4():void {
		$sut = new HTMLDocument("<h1>Testing character set</h1>", "ISO-8859-1");
		self::assertEquals("ISO-8859-1", $sut->characterSet);
	}

	public function testPropContentType():void {
		$sut = new HTMLDocument();
		self::assertEquals("text/html", $sut->contentType);
	}

	public function testDoctype():void {
		$sut = new HTMLDocument();
		self::assertInstanceOf(DocumentType::class, $sut->doctype);
	}

	public function testDocumentElementHTML():void {
		$sut = new HTMLDocument();
		self::assertSame(ElementType::HTMLHtmlElement, $sut->documentElement->elementType);
	}

	public function testEmbedsEmpty():void {
		$sut = new HTMLDocument();
		self::assertInstanceOf(HTMLCollection::class, $sut->embeds);
		self::assertEquals(0, $sut->embeds->length);
	}

	public function testEmbedsNonEmpty():void {
		$sut = new HTMLDocument(DocumentTestFactory::HTML_EMBED);
		self::assertEquals(1, $sut->embeds->length);
	}

	public function testEmbedsLive():void {
		$sut = new HTMLDocument(DocumentTestFactory::HTML_EMBED);
		// Reference "embeds" before another is added to the document.
		$embeds = $sut->embeds;
		$secondEmbed = $sut->createElement("embed");
		$sut->body->appendChild($secondEmbed);
		self::assertEquals(2, $embeds->length);
	}

	public function testFormsEmpty():void {
		$sut = new HTMLDocument();
		self::assertInstanceOf(HTMLCollection::class, $sut->forms);
		self::assertEquals(0, $sut->forms->length);
	}

	public function testFormsNonEmpty():void {
		$sut = new HTMLDocument(DocumentTestFactory::HTML_FORMS);
		self::assertEquals(
			substr_count(DocumentTestFactory::HTML_FORMS, "<form"),
			$sut->forms->length
		);
	}

	public function testFormsLive():void {
		$sut = new HTMLDocument(DocumentTestFactory::HTML_FORMS);
		// Reference "forms" before one is removed from the document.
		$forms = $sut->forms;
		$forms->item(0)->remove();
		self::assertEquals(
			substr_count(DocumentTestFactory::HTML_FORMS, "<form") - 1,
			$forms->length
		);
	}

	public function testHeadCreatedByDefaultHTML():void {
		$sut = new HTMLDocument(DocumentTestFactory::HTML_DEFAULT);
		self::assertSame(ElementType::HTMLHeadElement, $sut->head->elementType);
	}

	public function testHeadRemovable():void {
		$sut = new HTMLDocument(DocumentTestFactory::HTML_DEFAULT);
		$sut->head->remove();
		self::assertNull($sut->head);
	}

	public function testImagesEmpty():void {
		$sut = new HTMLDocument();
		self::assertSame(0, $sut->images->length);
		self::assertCount(0, $sut->images);
	}

	public function testImagesNonEmpty():void {
		$sut = new HTMLDocument(DocumentTestFactory::HTML_IMAGES);
		self::assertEquals(
			substr_count(DocumentTestFactory::HTML_IMAGES, "<img"),
			$sut->images->length
		);
	}

	public function testLinksEmpty():void {
		$sut = new HTMLDocument();
		self::assertEquals(0, $sut->links->length);
		self::assertCount(0, $sut->links);
	}

	public function testLinksLive():void {
		$sut = new HTMLDocument(DocumentTestFactory::HTML_PAGE);
		$substrCount = substr_count(DocumentTestFactory::HTML_PAGE, "<a href");
		$liveHTMLCollection = $sut->links;

		self::assertEquals(
			$substrCount,
			$liveHTMLCollection->length
		);

		$fourthAnchor = $sut->getElementsByTagName("a")->item(3);
		$fourthAnchor->remove();
		self::assertEquals(
			$substrCount - 1,
			$liveHTMLCollection->length
		);
	}

	public function testLinksArea():void {
		$sut = new HTMLDocument(DocumentTestFactory::HTML_AREA);
		$substrAHrefCount = substr_count(DocumentTestFactory::HTML_AREA, "<a href");
		$substrAreaCount = substr_count(DocumentTestFactory::HTML_AREA, "<area");
		self::assertCount(
			$substrAHrefCount + $substrAreaCount,
			$sut->links
		);
	}

	public function testScriptsEmpty():void {
		$sut = new HTMLDocument();
		self::assertEquals(0, $sut->scripts->length);
		self::assertCount(0, $sut->scripts);
	}

	public function testScripts():void {
		$sut = new HTMLDocument(DocumentTestFactory::HTML_PAGE);
		self::assertCount(2, $sut->scripts);
	}


	public function testStreamClosedByDefault():void {
		$sut = new HTMLDocument();
		self::assertFalse($sut->isWritable());
		self::expectException(DocumentStreamNotWritableException::class);
		$sut->write("test");
	}

	public function testStreamOpened():void {
		$sut = new HTMLDocument();
		$sut->open();
		self::assertTrue($sut->isWritable());
	}

	public function testClose():void {
		$sut = new HTMLDocument();
		$sut->open();
		self::assertTrue($sut->isWritable());
		$sut->close();
		self::assertFalse($sut->isWritable());
	}

	public function testWriteHTMLDocument():void {
		$message = "Hello from PHPUnit!";
		$sut = new HTMLDocument(DocumentTestFactory::HTML_DEFAULT);
		$sut->open();
		$sut->write($message);
		$stream = $sut->detach();
		$contents = stream_get_contents($stream);
		/** @noinspection HtmlRequiredLangAttribute */
		$expected = <<<HTML
		<!DOCTYPE html>
		<html><head></head><body><h1>Hello, PHP.Gt!</h1>$message</body></html>

		HTML;

		self::assertEquals($expected, $contents);
	}

	public function testWritelnHTMLDocument():void {
		$message1 = "Hello from PHPUnit!";
		$message2 = "Here is another message!";
		$sut = new HTMLDocument(DocumentTestFactory::HTML_DEFAULT);
		$sut->open();
		$sut->writeln($message1);
		$sut->writeln($message2);
		$stream = $sut->detach();
		$contents = stream_get_contents($stream);
		/** @noinspection HtmlRequiredLangAttribute */
		$expected = <<<HTML
		<!DOCTYPE html>
		<html><head></head><body><h1>Hello, PHP.Gt!</h1>$message1
		$message2
		</body></html>

		HTML;

		self::assertEquals($expected, $contents);
	}

	public function testCreateAttribute():void {
		$sut = new HTMLDocument();
		$attr = $sut->createAttribute("example");
		self::assertEquals("example", $attr->name);
		self::assertInstanceOf(Attr::class, $attr);
	}

	public function testCreateAttributeNS():void {
		$sut = new HTMLDocument();
		$attr = $sut->createAttributeNS("namespace", "example");
		self::assertEquals("example", $attr->name);
		self::assertEquals("namespace", $attr->namespaceURI);
	}

	public function testCreateCDATASectionHTML():void {
		$sut = new HTMLDocument();
		self::expectException(HTMLDocumentDoesNotSupportCDATASectionException::class);
		$sut->createCDATASection("");
	}

	public function testCreateComment():void {
		$sut = new HTMLDocument();
		$data = "This is an example comment!";
		$comment = $sut->createComment($data);
		self::assertEquals($data, $comment->nodeValue);
		self::assertInstanceOf(Comment::class, $comment);
	}

	public function testCreateDocumentFragment():void {
		$sut = new HTMLDocument();
		$fragment = $sut->createDocumentFragment();
		self::assertSame($sut, $fragment->ownerDocument);
		self::assertInstanceOf(DocumentFragment::class, $fragment);
	}

	public function testCreateElement():void {
		$sut = new HTMLDocument();
		foreach(["one", "two", "three"] as $number) {

			$elementName = "element-$number";
			$element = $sut->createElement($elementName);
			$elementType = $element->elementType;
			self::assertInstanceOf(Element::class, $element);
			self::assertSame(strtolower($elementName), $element->tagName);
			self::assertSame(ElementType::HTMLUnknownElement, $elementType);
			self::assertNull($element->namespaceURI);
		}
	}

	public function testCreateElementHTML():void {
		$sut = new HTMLDocument();
		foreach(["one", "two", "three"] as $number) {
			$elementName = "element-$number";
			$element = $sut->createElement($elementName);
			self::assertNull($element->namespaceURI);
		}
	}

	public function testCreateElementNS():void {
		$sut = new HTMLDocument();
		foreach(["one", "two", "three"] as $number) {
			$elementName = "element-$number";
			$namespace = uniqid("ns-");
			$element = $sut->createElementNS($namespace, $elementName);
			self::assertEquals(
				$namespace,
				$element->namespaceURI
			);
		}
	}

	public function testCreateNodeIterator():void {
		$sut = new HTMLDocument();
		$iterator = $sut->createNodeIterator($sut->body);
		self::assertIsIterable($iterator);
	}

	public function testCreateProcessingInstructionInvalidCharacter():void {
		$sut = new HTMLDocument();
		self::expectException(InvalidCharacterException::class);
		$sut->createProcessingInstruction("test", "?><?");
	}

	public function testCreateProcessingInstruction():void {
		$sut = new HTMLDocument();
		$pi = $sut->createProcessingInstruction("test", "example");
		self::assertSame($pi->ownerDocument, $sut);
	}

	public function testCreateTextNode():void {
		$sut = new HTMLDocument();
		$text = $sut->createTextNode("test text");
		self::assertSame($text->ownerDocument, $sut);
	}

	public function testCreateTreeWalker():void {
		$sut = new HTMLDocument();
		$treeWalker = $sut->createTreeWalker($sut->body);
		self::assertSame($sut->body, $treeWalker->currentNode);
	}

	public function testGetElementByIdNull():void {
		$sut = new HTMLDocument();
		self::assertNull($sut->getElementById("nothing-here"));
	}

	public function testGetElementById():void {
		$sut = new HTMLDocument();
		$child1 = $sut->createElement("child");
		$child1->id = "id-of-child1";
		$child2 = $sut->createElement("child");
		$child2->id = "id-of-child2";
		$child3 = $sut->createElement("child");
		$child3->id = "id-of-child3";
		$sut->body->appendChild($child1);
		$sut->body->appendChild($child2);
		$sut->body->appendChild($child3);

		$selected = $sut->getElementById("id-of-child2");
		self::assertSame($child2, $selected);
	}

	public function testGetElementsByClassNameEmpty():void {
		$sut = new HTMLDocument();
		$htmlCollection = $sut->getElementsByClassName("nothing here");
		self::assertCount(0, $htmlCollection);
	}

	public function testGetElementsByClassNameHTML():void {
		$sut = new HTMLDocument(DocumentTestFactory::HTML_PAGE);
		self::assertCount(6, $sut->getElementsByClassName("icon"));
	}

	public function testGetElementsByNameEmpty():void {
		$sut = new HTMLDocument();
		self::assertCount(0, $sut->getElementsByName("test"));
	}

	public function testGetElementsByName():void {
		$sut = new HTMLDocument(DocumentTestFactory::HTML_FORMS);
		self::assertCount(6, $sut->getElementsByName("continent"));
	}

	public function testGetElementsByNameLive():void {
		$sut = new HTMLDocument(DocumentTestFactory::HTML_FORMS);
		$continentList = $sut->getElementsByName("continent");
		$originalLength = $continentList->length;

		while($input = $sut->querySelector("input")) {
			$input->remove();
		}

		self::assertLessThan($originalLength, $continentList->length);
		self::assertCount(0, $continentList);
	}

	public function testGetElementsByTagNameEmpty():void {
		$sut = new HTMLDocument();
		self::assertCount(0, $sut->getElementsByName("input"));
	}

	public function testGetElementsByTagName():void {
		$sut = new HTMLDocument(DocumentTestFactory::HTML_FORMS);
		self::assertCount(4, $sut->getElementsByTagName("label"));
	}

	public function testGetElementsByTagNameLive():void {
		$sut = new HTMLDocument(DocumentTestFactory::HTML_FORMS);
		$inputList = $sut->getElementsByTagName("input");

		while($currentLength = $inputList->length) {
			$sut->querySelector("input")->remove();
			self::assertCount($currentLength - 1, $inputList);
		}
	}

	public function testGetElementsByTagNameNSEmpty():void {
		$sut = new HTMLDocument();
		self::assertCount(
			0,
			$sut->getElementsByTagNameNS(
				"http://www.w3.org/1999/xhtml",
				"p"
			)
		);
	}

	public function testGetElementsByTagNameNS():void {
		$sut = new HTMLDocument(DocumentTestFactory::HTML_FORMS);
		self::assertCount(
			4,
			$sut->getElementsByTagNameNS(
				"", // Empty for HTML5
				"label"
			)
		);
		self::assertCount(
			0,
			$sut->getElementsByTagNameNS(
				"non-matching",
				"label"
			)
		);
	}

	public function testImportNode():void {
		$sut1 = new HTMLDocument();
		$sut2 = new HTMLDocument();

// First try to append the node to the wrong document.
		$node = $sut1->createElement("example");
		$exception = null;
		try {
			$sut2->body->appendChild($node);
		}
		catch(WrongDocumentErrorException $exception) {
		}
// Ensure an exception was caught.
		self::assertNotNull($exception);

// Import the node, but ensure the original node is untouched.
		self::assertEquals($sut1, $node->ownerDocument);
		$newNode = $sut2->importNode($node);
		$sut2->body->appendChild($newNode);
		self::assertEquals($sut1, $node->ownerDocument);
		self::assertEquals($sut2, $newNode->ownerDocument);
		$newNode->remove();

// The original node should still not be able to be attached to the other document.
		$exception = null;
		try {
			$sut2->body->appendChild($node);
		}
		catch(WrongDocumentErrorException $exception) {
		}
		self::assertNotNull($exception);
	}

	public function testTextContent():void {
		$sut = new HTMLDocument();
		self::assertSame('', $sut->textContent);
	}

	public function testAppendChildNotEmpty():void {
		$sut = new HTMLDocument();
		$node = $sut->createElement("example");
		self::expectException(DocumentHasMoreThanOneElementChildException::class);
		$sut->appendChild($node);
	}

	public function testAppendChildText():void {
		$sut = new HTMLDocument();
		self::expectException(TextNodeCanNotBeRootNodeException::class);
		$sut->appendChild($sut->createTextNode("Hello!"));
	}

	public function testIsEqualNode():void {
		$sut = new HTMLDocument();
		$other = new HTMLDocument();
		self::assertTrue($sut->isEqualNode($other));
	}

	public function testEvaluateDodgyXPath():void {
		$sut = new HTMLDocument();
		self::expectException(XPathQueryException::class);
		$sut->evaluate("la la la 123@456 [#]");
	}
}
