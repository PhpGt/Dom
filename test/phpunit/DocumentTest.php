<?php
namespace Gt\Dom\Test;

use DOMDocument;
use Gt\Dom\Document;
use Gt\Dom\DocumentType;
use Gt\Dom\Element;
use Gt\Dom\Exception\DocumentHasMoreThanOneElementChildException;
use Gt\Dom\Exception\DocumentStreamNotWritableException;
use Gt\Dom\Exception\HTMLDocumentDoesNotSupportCDATASectionException;
use Gt\Dom\Exception\InvalidCharacterException;
use Gt\Dom\Exception\TextNodeCanNotBeRootNodeException;
use Gt\Dom\Exception\WriteOnNonHTMLDocumentException;
use Gt\Dom\Exception\WrongDocumentErrorException;
use Gt\Dom\Exception\XPathQueryException;
use Gt\Dom\HTMLCollection;
use Gt\Dom\HTMLDocument;
use Gt\Dom\HTMLElement\HTMLBodyElement;
use Gt\Dom\HTMLElement\HTMLHeadElement;
use Gt\Dom\Test\TestFactory\DocumentTestFactory;
use Gt\Dom\Test\TestFactory\NodeTestFactory;
use Gt\PropFunc\PropertyReadOnlyException;
use PHPUnit\Framework\TestCase;

class DocumentTest extends TestCase {
	public function testToStringEmpty():void {
		$sut = new Document();
		self::assertEquals(PHP_EOL, (string)$sut);
	}

	public function testBodyNullByDefault():void {
		$sut = new Document();
		self::assertNull($sut->body);
	}

	public function testBodyReadOnly():void {
		$sut = new Document();
		$property = "body";
		self::expectException(PropertyReadOnlyException::class);
		/** @phpstan-ignore-next-line */
		$sut->$property = "can-not-set";
	}

	public function testBodyInstanceOfHTMLBodyElementEmptyHTML():void {
		$sut = DocumentTestFactory::createHTMLDocument("");
		self::assertInstanceOf(HTMLBodyElement::class, $sut->body);
	}

	public function testBodyInstanceOfHTMLBodyElementDefaultHTML():void {
		$sut = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_DEFAULT);
		self::assertInstanceOf(HTMLBodyElement::class, $sut->body);
	}

	public function testToStringEmptyHTML():void {
		$sut = DocumentTestFactory::createHTMLDocument("");
		self::assertEquals("<!DOCTYPE html>\n<html><head></head><body></body></html>\n", (string)$sut);
	}

	public function testToStringDefaultHTML():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		self::assertEquals("<!DOCTYPE html>\n<html><head></head><body><h1>Hello, PHP.Gt!</h1></body></html>\n", (string)$sut);
	}

	public function testBodyNullOnXML():void {
		$sut = DocumentTestFactory::createXMLDocument();
		self::assertNull($sut->body);
	}

	public function testToStringEmptyXML():void {
		$sut = DocumentTestFactory::createXMLDocument("");
		self::assertEquals("<?xml version=\"1.0\" encoding=\"utf-8\"?>\n", (string)$sut);
	}

	public function testCharacterSetUnset():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		self::assertEquals("", $sut->characterSet);
	}

	public function testCharacterSetUTF8():void {
		$sut = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_DEFAULT_UTF8);
		self::assertEquals("UTF-8", $sut->characterSet);
	}

	public function testContentTypeEmpty():void {
		$sut = new Document();
		self::assertEquals("", $sut->contentType);
	}

	public function testContentTypeHTMLDocument():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		self::assertEquals("text/html", $sut->contentType);
	}

	public function testContentTypeXMLDocument():void {
		$sut = DocumentTestFactory::createXMLDocument();
		self::assertEquals("text/xml", $sut->contentType);
	}

	public function testDoctypeEmpty():void {
		$sut = new Document();
		self::assertNull($sut->doctype);
	}

	public function testDoctypeHTML():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		self::assertInstanceOf(DocumentType::class, $sut->doctype);
	}

	public function testDoctypeXML():void {
		$sut = DocumentTestFactory::createXMLDocument(DocumentTestFactory::XML_BOOK);
		self::assertInstanceOf(DocumentType::class, $sut->doctype);
	}

	public function testDocumentElementEmpty():void {
		$sut = new Document();
		self::assertNull($sut->documentElement);
	}

	public function testDocumentElementHTML():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		self::assertInstanceOf(Element::class, $sut->documentElement);
	}

	public function testDocumentElementXML():void {
		$sut = DocumentTestFactory::createXMLDocument();
		self::assertInstanceOf(Element::class, $sut->documentElement);
	}

	public function testEmbedsEmpty():void {
		$sut = new Document();
		self::assertInstanceOf(HTMLCollection::class, $sut->embeds);
		self::assertEquals(0, $sut->embeds->length);
	}

	public function testEmbedsNonEmpty():void {
		$sut = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_EMBED);
		self::assertEquals(1, $sut->embeds->length);
	}

	public function testEmbedsLive():void {
		$sut = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_EMBED);
		// Reference "embeds" before another is added to the document.
		$embeds = $sut->embeds;
		$secondEmbed = $sut->createElement("embed");
		$sut->body->appendChild($secondEmbed);
		self::assertEquals(2, $embeds->length);
	}

	public function testFormsEmpty():void {
		$sut = new Document();
		self::assertInstanceOf(HTMLCollection::class, $sut->forms);
		self::assertEquals(0, $sut->forms->length);
	}

	public function testFormsNonEmpty():void {
		$sut = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_FORMS);
		self::assertEquals(
			substr_count(DocumentTestFactory::HTML_FORMS, "<form"),
			$sut->forms->length
		);
	}

	public function testFormsLive():void {
		$sut = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_FORMS);
		// Reference "forms" before one is removed from the document.
		$forms = $sut->forms;
		$forms->item(0)->remove();
		self::assertEquals(
			substr_count(DocumentTestFactory::HTML_FORMS, "<form") - 1,
			$forms->length
		);
	}

	public function testHeadNullOnEmpty():void {
		$sut = new Document();
		self::assertNull($sut->head);
	}

	public function testHeadNullOnXML():void {
		$sut = DocumentTestFactory::createXMLDocument();
		self::assertNull($sut->head);
	}

	public function testHeadNullOnXMLWithHeadElement():void {
		$sut = DocumentTestFactory::createXMLDocument(DocumentTestFactory::XML_ANIMAL_PARTS);
		self::assertNull($sut->head);
	}

	public function testHeadCreatedByDefaultHTML():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		self::assertInstanceOf(HTMLHeadElement::class, $sut->head);
	}

	public function testHeadRemovable():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		$sut->head->remove();
		self::assertNull($sut->head);
	}

	public function testImagesEmpty():void {
		$sut = new Document();
		self::assertEquals(0, $sut->images->length);
		self::assertCount(0, $sut->images);
	}

	public function testImagesEmptyXML():void {
		$sut = DocumentTestFactory::createXMLDocument();
		self::assertEquals(0, $sut->images->length);
	}

	public function testImagesNonEmpty():void {
		$sut = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_IMAGES);
		self::assertEquals(
			substr_count(DocumentTestFactory::HTML_IMAGES, "<img"),
			$sut->images->length
		);
	}

	public function testLinksEmpty():void {
		$sut = new Document();
		self::assertEquals(0, $sut->links->length);
		self::assertCount(0, $sut->links);
	}

	public function testLinksEmptyXML():void {
		$sut = DocumentTestFactory::createXMLDocument();
		self::assertCount(0, $sut->links);
	}

	public function testLinksLive():void {
		$sut = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_PAGE);
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
		$sut = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_AREA);
		$substrAHrefCount = substr_count(DocumentTestFactory::HTML_AREA, "<a href");
		$substrAreaCount = substr_count(DocumentTestFactory::HTML_AREA, "<area");
		self::assertCount(
			$substrAHrefCount + $substrAreaCount,
			$sut->links
		);
	}

	public function testScriptsEmpty():void {
		$sut = new Document();
		self::assertEquals(0, $sut->scripts->length);
		self::assertCount(0, $sut->scripts);
	}

	public function testScriptsEmptyXML():void {
		$sut = DocumentTestFactory::createXMLDocument();
		self::assertEquals(0, $sut->scripts->length);
		self::assertCount(0, $sut->scripts);
	}

	public function testScripts():void {
		$sut = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_PAGE);
		self::assertCount(2, $sut->scripts);
	}

	public function testAdoptNodeSameDocument():void {
		$sut = new Document();
		$div = $sut->createElement("div");
		$divOwner = $div->ownerDocument;
		self::assertSame($divOwner, $sut);

		$divAdopted = $sut->adoptNode($div);
		self::assertSame($div, $divAdopted);
		self::assertSame($divAdopted->ownerDocument, $sut);
		self::assertSame($divAdopted->ownerDocument, $div->ownerDocument);
	}

	public function testAdoptNodeOwnerDocument():void {
		$sut1 = new Document();
		$div = $sut1->createElement("div");
		$divOwner = $div->ownerDocument;
		self::assertSame($divOwner, $sut1);

		$sut2 = new Document();
		$divAdopted = $sut2->adoptNode($div);
		$divAdoptedOwner = $divAdopted->ownerDocument;
		$divOwner = $div->ownerDocument;

		self::assertSame($divAdoptedOwner, $sut2, "The owner of the div after adoption must be the second document");
		self::assertSame($divOwner, $sut2, "The original DIV's ownerDocument must change to the second document");
		self::assertSame($div, $divAdopted, "The node should not change its reference after it has been adopted");
	}

	public function testAdoptNodeRemovesParent():void {
		$sut1 = new Document();
		$body1 = $sut1->createElement("body");
		$sut1->appendChild($body1);
		$div = $sut1->createElement("div");
		$body1->appendChild($div);
		$sut2 = new Document();

		self::assertSame($body1, $div->parentNode);
		$sut2->adoptNode($div);
		self::assertNull($div->parentNode);
	}

	public function testStreamClosedByDefault():void {
		$sut = new Document();
		self::assertFalse($sut->isWritable());
		self::expectException(DocumentStreamNotWritableException::class);
		$sut->write("test");
	}

	public function testStreamOpenedByHTMLDocument():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		self::assertTrue($sut->isWritable());
	}

	public function testStreamOpenedByXMLDocument():void {
		$sut = DocumentTestFactory::createXMLDocument();
		self::assertTrue($sut->isWritable());
	}

	public function testClose():void {
		$sut = new Document();
		$sut->open();
		self::assertTrue($sut->isWritable());
		$sut->close();
		self::assertFalse($sut->isWritable());
	}

	public function testWriteDirectlyToDocument():void {
		$message = "Hello from PHPUnit!";
		$sut = new Document();
		$sut->open();
		self::expectException(WriteOnNonHTMLDocumentException::class);
		$sut->write($message);
	}

	public function testWriteHTMLDocument():void {
		$message = "Hello from PHPUnit!";
		$sut = DocumentTestFactory::createHTMLDocument();
		$sut->open();
		$sut->write($message);
		$stream = $sut->detach();
		$contents = stream_get_contents($stream);
		$expected = <<<HTML
		<!DOCTYPE html>
		<html><head></head><body><h1>Hello, PHP.Gt!</h1>$message</body></html>
		
		HTML;

		self::assertEquals($expected, $contents);
	}

	public function testWritelnHTMLDocument():void {
		$message1 = "Hello from PHPUnit!";
		$message2 = "Here is another message!";
		$sut = DocumentTestFactory::createHTMLDocument();
		$sut->open();
		$sut->writeln($message1);
		$sut->writeln($message2);
		$stream = $sut->detach();
		$contents = stream_get_contents($stream);
		$expected = <<<HTML
		<!DOCTYPE html>
		<html><head></head><body><h1>Hello, PHP.Gt!</h1>$message1
		$message2
		</body></html>
		
		HTML;

		self::assertEquals($expected, $contents);
	}

	public function testCreateAttribute():void {
		$sut = new Document();
		$attr = $sut->createAttribute("example");
		self::assertEquals("example", $attr->name);
	}

	public function testCreateAttributeNS():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		$attr = $sut->createAttributeNS("namespace", "example");
		self::assertEquals("example", $attr->name);
		self::assertEquals("namespace", $attr->namespaceURI);
	}

	public function testCreateCDATASectionHTML():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		self::expectException(HTMLDocumentDoesNotSupportCDATASectionException::class);
		$sut->createCDATASection("");
	}

	public function testCreateCDATASection():void {
		$sut = new Document();
		$data = "Example CDATASection data!";
		$cdata = $sut->createCDATASection($data);
		self::assertEquals($data, $cdata->nodeValue);
	}

	public function testCreateCDATASectionInvalidCharacter():void {
		$sut = new Document();
		$data = "Illegal Characters ]]>";
		self::expectException(InvalidCharacterException::class);
		$sut->createCDATASection($data);
	}

	public function testCreateComment():void {
		$sut = new Document();
		$data = "This is an example comment!";
		$comment = $sut->createComment($data);
		self::assertEquals($data, $comment->nodeValue);
	}

	public function testCreateDocumentFragment():void {
		$sut = new Document();
		$fragment = $sut->createDocumentFragment();
		self::assertSame($sut, $fragment->ownerDocument);
	}

	public function testCreateElement():void {
		$sut = new Document();
		foreach(["one", "two", "three"] as $number) {
			$elementName = "element-$number";
			$element = $sut->createElement($elementName);
			self::assertInstanceOf(Element::class, $element);
			self::assertEquals(strtoupper($elementName), $element->tagName);
			self::assertNull($element->namespaceURI);
		}
	}

	public function testCreateElementHTML():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		foreach(["one", "two", "three"] as $number) {
			$elementName = "element-$number";
			$element = $sut->createElement($elementName);
			self::assertEquals(
				HTMLDocument::W3_NAMESPACE,
				$element->namespaceURI
			);
		}
	}

	public function testCreateElementNS():void {
		$sut = new Document();
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
		$sut = DocumentTestFactory::createHTMLDocument();
		$iterator = $sut->createNodeIterator($sut->body);
		self::assertIsIterable($iterator);
	}

	public function testCreateProcessingInstructionInvalidCharacter():void {
		$sut = new Document();
		self::expectException(InvalidCharacterException::class);
		$sut->createProcessingInstruction("test", "?><?");
	}

	public function testCreateProcessingInstruction():void {
		$sut = new Document();
		$pi = $sut->createProcessingInstruction("test", "example");
		self::assertSame($pi->ownerDocument, $sut);
	}

	public function testCreateTextNode():void {
		$sut = new Document();
		$text = $sut->createTextNode("test");
		self::assertSame($text->ownerDocument, $sut);
	}

	public function testCreateTreeWalker():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		$treeWalker = $sut->createTreeWalker($sut->body);
		self::assertSame($sut->body, $treeWalker->currentNode);
	}

	public function testGetElementByIdNull():void {
		$sut = new Document();
		self::assertNull($sut->getElementById("nothing-here"));
	}

	public function testGetElementByIdNoDoctypeNull():void {
		$sut = new Document();
		$root = $sut->createElement("root");
		$sut->appendChild($root);
		$root->id = "test";
		self::assertNull($sut->getElementById("test"));
	}

	public function testGetElementById():void {
		$sut = DocumentTestFactory::createHTMLDocument();
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

	public function testGetElementByIdXMLBug():void {
// There is a known bug in XML documents where getElementById doesn't actually
// match elements. This has been patched by Gt\Dom, but to prove it, this test
// will expose the original bug on the native document.
		$bugDocument = new DOMDocument("1.0", "UTF-8");
		$bugDocument->loadXML(DocumentTestFactory::XML_SHAPE);
		$missingElement = $bugDocument->getElementById("target");
// This _shouldn't_ be null, but it is in the libxml2 implementation (buggy!)
		self::assertNull($missingElement);

		$sut = DocumentTestFactory::createXMLDocument(DocumentTestFactory::XML_SHAPE);
		$element = $sut->getElementById("target");
		self::assertInstanceOf(Element::class, $element);
		self::assertEquals("CIRCLE", $element->tagName);
	}

	public function testGetElementsByClassNameEmpty():void {
		$sut = new Document();
		$htmlCollection = $sut->getElementsByClassName("nothing here");
		self::assertCount(0, $htmlCollection);
	}

	public function testGetElementsByClassName():void {
		$sut = new Document();
		$root = $sut->createElement("root");
		$sut->appendChild($root);
		$trunk = $sut->createElement("trunk");
		$root->appendChild($trunk);
		$leaf = $sut->createElement("leaf");
		$trunk->appendChild($leaf);

		$root->className = "below-ground brown";
		$trunk->className = "above-ground brown";
		$leaf->className = "above-ground green";

		self::assertCount(
			2,
			$sut->getElementsByClassName("above-ground")
		);
		self::assertCount(
			1,
			$sut->getElementsByClassName("green")
		);
		self::assertCount(
			2,
			$sut->getElementsByClassName("brown")
		);
	}

	public function testGetElementsByClassNameHTML():void {
		$sut = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_PAGE);
		self::assertCount(6, $sut->getElementsByClassName("icon"));
	}

	public function testGetElementsByNameEmpty():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		self::assertCount(0, $sut->getElementsByName("test"));
	}

	public function testGetElementsByName():void {
		$sut = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_FORMS);
		self::assertCount(6, $sut->getElementsByName("continent"));
	}

	public function testGetElementsByNameLive():void {
		$sut = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_FORMS);
		$continentList = $sut->getElementsByName("continent");
		$originalLength = $continentList->length;

		while($input = $sut->querySelector("input")) {
			$input->remove();
		}

		self::assertLessThan($originalLength, $continentList->length);
		self::assertCount(0, $continentList);
	}

	public function testGetElementsByTagNameEmpty():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		self::assertCount(0, $sut->getElementsByName("input"));
	}

	public function testGetElementsByTagName():void {
		$sut = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_FORMS);
		self::assertCount(4, $sut->getElementsByTagName("label"));
	}

	public function testGetElementsByTagNameLive():void {
		$sut = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_FORMS);
		$inputList = $sut->getElementsByTagName("input");

		while($currentLength = $inputList->length) {
			$sut->querySelector("input")->remove();
			self::assertCount($currentLength - 1, $inputList);
		}
	}

	public function testGetElementsByTagNameNSEmpty():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		self::assertCount(
			0,
			$sut->getElementsByTagNameNS(
				"http://www.w3.org/1999/xhtml",
				"p"
			)
		);
	}

	public function testGetElementsByTagNameNS():void {
		$sut = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_FORMS);
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
		$sut1 = new Document();
		$sut2 = new Document();

// First try to append the node to the wrong document.
		$node = $sut1->createElement("example");
		$exception = null;
		try {
			$sut2->appendChild($node);
		}
		catch(WrongDocumentErrorException $exception) {
		}
// Ensure an exception was caught.
		self::assertNotNull($exception);

// Import the node, but ensure the original node is untouched.
		self::assertEquals($sut1, $node->ownerDocument);
		/** @var Element $newNode */
		$newNode = $sut2->importNode($node);
		$sut2->appendChild($newNode);
		self::assertEquals($sut1, $node->ownerDocument);
		self::assertEquals($sut2, $newNode->ownerDocument);
		$newNode->remove();

// The original node should still not be able to be attached to the other document.
		$exception = null;
		try {
			$sut2->appendChild($node);
		}
		catch(WrongDocumentErrorException $exception) {
		}
		self::assertNotNull($exception);
	}

	public function testTextContent():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		self::assertNull($sut->textContent);
	}

	public function testAppendChild():void {
		$sut = new Document();
		$node = $sut->createElement("example");
		self::assertCount(0, $sut->childNodes);
		$sut->appendChild($node);
		self::assertCount(1, $sut->childNodes);
	}

	public function testAppendChildNotEmpty():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		$node = $sut->createElement("example");
		self::expectException(DocumentHasMoreThanOneElementChildException::class);
		$sut->appendChild($node);
	}

	public function testAppendChildText():void {
		$sut = new Document();
		self::expectException(TextNodeCanNotBeRootNodeException::class);
		$sut->appendChild($sut->createTextNode("Hello!"));
	}

	public function testIsEqualNode():void {
		$sut = new Document();
		$other = new Document();
		self::assertFalse($sut->isEqualNode($other));
	}

	public function testEvaluateDodgyXPath():void {
		$sut = new Document();
		self::expectException(XPathQueryException::class);
		$sut->evaluate("lalala 123@456 [#]");
	}
}
