<?php
namespace Gt\Dom\Test;

use DateTime;
use Gt\Dom\Element;
use Gt\Dom\HTMLDocument;
use Gt\Dom\Test\Helper\Helper;
use Gt\Dom\Text;
use Gt\Dom\TokenList;
use PHPUnit\Framework\TestCase;

class ElementTest extends TestCase {
	public function testQuerySelector() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$pAfterH2 = $document->querySelector("h2+p");
		$aWithinP = $pAfterH2->querySelector("a");

		$a = $document->querySelector("p>a");

		$this->assertInstanceOf(Element::class, $pAfterH2);
		$this->assertInstanceOf(Element::class, $aWithinP);
		$this->assertInstanceOf(Element::class, $a);
		$this->assertSame($a, $aWithinP);
	}

	public function testQuerySelectorAll() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$pCollection = $document->documentElement->querySelectorAll("p");
		$pNodeList = $document->documentElement->getElementsByTagName("p");

		$this->assertEquals($pNodeList->length, $pCollection->length);
	}

	public function testMatches() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$p = $document->getElementsByClassName("plug")->item(0);

		$this->assertTrue($p->matches("p"));
		$this->assertTrue($p->matches("p.plug"));
		$this->assertTrue($p->matches("body>p:nth-of-type(3)"));
		$this->assertTrue($p->matches("p:nth-of-type(3)"));
		$this->assertTrue($p->matches("body>*"));
		$this->assertFalse($p->matches("div"));
		$this->assertFalse($p->matches("body>p:nth-of-type(4)"));
	}

	public function testChildElementCount() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		// There is 1 text node within the document.
		$this->assertGreaterThan(
			$document->body->childElementCount,
			$document->body->childNodes->length
		);
		$this->assertEquals(
			$document->body->children->length,
			$document->body->childElementCount
		);
	}

	public function testElementClosest() {
		$document = new HTMLDocument(Helper::HTML_NESTED);

		$p = $document->querySelector('.inner-list p');
		$this->assertInstanceOf(Element::class, $p);

		$innerList = $document->querySelector('.inner-list');
		$this->assertInstanceOf(Element::class, $innerList);

		$closestUl = $innerList->closest('ul');
		$this->assertEquals($innerList, $closestUl);

		$container = $p->closest('.container');
		$this->assertInstanceOf(Element::class, $container);

		$nonExistentClosestElement = $p->closest('br');
		$this->assertNull($nonExistentClosestElement);

		$innerPost = $document->querySelector("div.post.inner");
		$innerListItem = $document->querySelector(".inner-item-1");
		$outerPost = $document->querySelector("div.post.outer");
		$this->assertInstanceOf(Element::class, $innerPost);
		$this->assertInstanceOf(Element::class, $outerPost);

		$closestDivToInnerListItem = $innerListItem->closest("div");
		$closestDivToInnerPost = $innerPost->closest("div");
// ..the inner post should match itself, as it is a div.
		$this->assertSame($closestDivToInnerPost, $innerPost);
// ..but the inner list item should match up the tree to the outer post
// ..missing the other divs in the tree.
		$this->assertSame($closestDivToInnerListItem, $outerPost);
	}

	public function testValueGetter() {
		$document = new HTMLDocument(Helper::HTML_VALUE);

		$select = $document->getElementById('select');
		$this->assertEquals('1', $select->value);
		$select->value = '2';
		$this->assertEquals('2', $select->value);

		$select = $document->getElementById('select_optgroup');
		$this->assertEquals('3', $select->value);
		$select->value = '4';
		$this->assertEquals('4', $select->value);

		$select = $document->getElementById('select_selected');
		$this->assertEquals('2', $select->value);

		$select = $document->getElementById('select_empty');
		$this->assertEquals('', $select->value);
		$select->value = 'dummy';
		$this->assertEquals('', $select->value);

// For #201:
		$select = $document->getElementById("select_inferred_value");
		$this->assertEquals("Two", $select->value);
	}

// For #201:
	public function testSelectValueSetterToValueAttribute() {
		$document = new HTMLDocument(Helper::HTML_VALUE);
		$select = $document->getElementById("select_inferred_value");
		$this->assertEquals("Two", $select->value);
		$select->value = "Three";
		$this->assertEquals("Three", $select->value);
	}

	public function testInnerHTML() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$p = $document->querySelector(".link-to-twitter");
		$this->assertStringContainsString("<a href=", $p->innerHTML);
		$this->assertStringContainsString("Greg Bowler", $p->innerHTML);
		$this->assertStringNotContainsString("<p", $p->innerHTML);

		$p->innerHTML = "This is <strong>very</strong> important!";
		$this->assertInstanceOf(Element::class, $p->querySelector("strong"));
		$this->assertStringContainsString("This is", $p->textContent);
		$this->assertStringContainsString("very", $p->textContent);
		$this->assertEquals("very", $p->querySelector("strong")->textContent);
	}

	public function testInnerHTMLWithJson() {
// This test comes from a real world use-case, where the value of a JSON
// property within a <script> tag needed updating on the fly. It didn't make
// practical sense to encode/decode the JSON, so str_replace was used to update
// a placeholder. In the wild, this caused HTML entities to appear everywhere,
// incorrectly.
		$document = new HTMLDocument(Helper::HTML_JSON_HEAD);
		$ratingValue = "4.5";
		$ratingCount = 1337;
		$script = $document->querySelector(".php-schema-rating");

		self::assertStringContainsString(
			"\"aggregateRating\": {",
			$script->innerHTML
		);

		$script->innerHTML = str_replace([
			"__RATING_VALUE__",
			"__RATING_COUNT__",
		], [
			$ratingValue,
			$ratingCount,
		], $script->innerHTML);

		self::assertStringContainsString(
			"\"aggregateRating\": {",
			$script->innerHTML
		);

		$json = json_decode($script->innerHTML);
		self::assertEquals($ratingValue, $json->aggregateRating->ratingValue);
		self::assertEquals($ratingCount, $json->aggregateRating->ratingCount);
	}

	public function testOuterHTML() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$p = $document->querySelector(".link-to-twitter");
		$this->assertStringContainsString("<a href=", $p->outerHTML);
		$this->assertStringContainsString("Greg Bowler", $p->outerHTML);
		$this->assertStringContainsString("<p", $p->outerHTML);
		$this->assertStringContainsString("</p>", $p->outerHTML);
		$this->assertStringNotContainsString("<h2", $p->outerHTML);
		$this->assertStringNotContainsString("name=\"forms\">", $p->outerHTML);
	}

	public function testClassListProperty() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$element = $document->getElementById("who");
		$this->assertInstanceOf(TokenList::class, $element->classList);

		$this->assertTrue($element->classList->contains("m-before-p"));
		$this->assertFalse($element->classList->contains("nothing"));
	}

	public function testClassNameProperty() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$element = $document->getElementById("who");
		$this->assertIsString($element->className);

		$this->assertStringContainsString("m-before-p", $element->className);
		$this->assertStringNotContainsString("nothing", $element->className);
	}

	public function testIdProperty() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$element = $document->getElementById("who");
		$this->assertEquals("who", $element->id);
	}

	public function testTagNameProperty() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$element = $document->getElementsByTagName("form")[0];
		$this->assertEquals("form", $element->tagName);
	}

	public function testValueProperty() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$paragraph = $document->getElementById("who");
		$this->assertNull($paragraph->value);

		$input = $document->querySelector("form input[name=who]");
		$this->assertEquals("Scarlett", $input->value);

		$input->value = "Sparky";
		$this->assertEquals("Sparky", $input->getAttribute("value"));
	}

	public function testRemove() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$bodyChildrenCount = count($document->body->children);
		$paragraph = $document->querySelector("p");
		$paragraph->remove();
		$this->assertCount($bodyChildrenCount - 1, $document->body->children);
	}

	public function testTextContentDoesNotAffectChildElements() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$firstParagraph = $document->querySelector("p");
		$firstParagraph->innerText = "<span>Example</span>";
// TODO: Check that the childNodes property ends up as a Gt Dom HTMLCollection
		$this->assertGreaterThan(0, count($firstParagraph->childNodes));

		foreach($firstParagraph->childNodes as $child) {
// There should not be any "span" elements, only text including optional whitespace.
			$this->assertInstanceOf(Text::class, $child);
		}
	}

	/**
	 * The test passes, but IDEs do not show the correct types.
	 */
	public function testNodeFunctionsReturnGtObjects() {
		$objectsThatShouldBeElements = [];
		$document = new HTMLDocument(Helper::HTML);
		$h1 = $document->querySelector("h1");
		$objectsThatShouldBeElements["h1"] = $h1;
		$objectsThatShouldBeElements["h1Clone"] = $h1->cloneNode(true);
		$objectsThatShouldBeElements["parent"] = $h1->parentNode;
		$objectsThatShouldBeElements["firstChild"] = $document->body->firstChild;

		$otherDocument = new HTMLDocument();
		$otherDiv = $otherDocument->createElement("div");
		$objectsThatShouldBeElements["imported"] = $document->importNode($otherDiv);
		$objectsThatShouldBeElements["imported-appended"] = $document->appendChild(
			$objectsThatShouldBeElements["imported"]);

		foreach($objectsThatShouldBeElements as $key => $object) {
			$this->assertInstanceOf(
				Element::class,
				$object,
				"$key instance of " . gettype($object));
		}
	}

	public function testGetInnerText() {
		$document = new HTMLDocument(Helper::HTML);
		$h1 = $document->querySelector("h1");
		$this->assertEquals("Hello!", $h1->innerText);
	}

	public function testSetInnerText() {
		$document = new HTMLDocument(Helper::HTML);
		$h1 = $document->querySelector("h1");
		$h1->innerText = "Goodbye!";
		$this->assertEquals("Goodbye!", $h1->textContent);
	}

	public function testGetNonExistingIdGivesNull() {
		$document = new HTMLDocument(Helper::HTML);
		$body = $document->getElementsByTagName("body")[0] ?? null;
		self::assertNotNull($body);
		/** @var Element $body */
		$idByGetAttribute = $body->getAttribute('id');
		self::assertNull($idByGetAttribute);
		$idByPropGetId = $body->prop_get_id();
		self::assertNull($idByPropGetId);
		$idByMagicGet = $body->id;
		self::assertNull($idByMagicGet);
	}

	public function testDataset() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$p = $document->querySelector("p.link-to-twitter");

		self::assertEquals(
			"twitter",
			$p->dataset->social
		);
		self::assertEquals(
			"g105b",
			$p->dataset->socialUsername
		);
	}

	public function testDatasetSetGet() {
		$document = new HTMLDocument();
		$element = $document->createElement("div");
		$message = "Hello, World!";
		$element->dataset->message = $message;

		self::assertEquals(
			$message,
			$element->dataset->message
		);
	}

	public function testDatasetCreateElement() {
		$document = new HTMLDocument();
		$element = $document->createElement("div");
		$element->dataset->name = "Example";
		$element->dataset->multiWord = "Should be hyphenated";

		self::assertEquals(
			$element->dataset->name,
			$element->getAttribute("data-name")
		);
		self::assertEquals(
			$element->dataset->multiWord,
			$element->getAttribute("data-multi-word")
		);
	}

	public function testDatasetArrayAccess() {
		$document = new HTMLDocument();
		$element = $document->createElement("div");
		$element->dataset->name = "Example";

		self::assertEquals(
			$element->dataset->name,
			$element->dataset["name"]
		);
	}

	public function testDatasetArrayAccessIssetUnset() {
		$document = new HTMLDocument();
		$element = $document->createElement("div");
		$element->dataset->name = "Example";

		self::assertTrue(isset($element->dataset["name"]));
		unset($element->dataset["name"]);
		self::assertFalse(isset($element->dataset["name"]));
	}

	public function testDatasetIssetUnset() {
		$document = new HTMLDocument();
		$element = $document->createElement("div");

		self::assertFalse(isset($element->dataset->name));
		$element->dataset->name = "Example";
		self::assertTrue(isset($element->dataset->name));
		unset($element->dataset->name);
		self::assertFalse(isset($element->dataset->name));
	}

	public function testFormControlElementsCanHaveFormProperty() {
		$document = new HTMLDocument(Helper::HTML_FORM_PROPERTY);
		$form = $document->getElementById('form_2');

		$input = $document->getElementById('f2');
		self::assertEquals($form, $input->form);

		$button = $document->getElementById('f4');
		self::assertEquals($form, $button->form);

		$fieldset = $document->getElementById('f5');
		self::assertEquals($form, $fieldset->form);

		$input = $document->getElementById('f6');
		self::assertEquals($form, $input->form);

		$object = $document->getElementById('f7');
		self::assertEquals($form, $object->form);

		$output = $document->getElementById('f8');
		self::assertEquals($form, $output->form);

		$select = $document->getElementById('f9');
		self::assertEquals($form, $select->form);
	}

	public function testFormControlElementReturnsParentFormAsFormPropertyIfItDoesNotHaveFormAttribute() {
		$document = new HTMLDocument(Helper::HTML_FORM_PROPERTY);
		$form = $document->getElementById('form_1');

		$input = $document->getElementById('f1');
		self::assertEquals($form, $input->form);

		$button = $document->getElementById('f3');
		self::assertEquals($form, $button->form);
	}

	public function testFormControlElementReturnsNullIfItDoesNotHaveFormAttributeAndDoesNotHaveParentForm() {
		$document = new HTMLDocument(Helper::HTML_FORM_PROPERTY);

		$input = $document->getElementById('f11');
		self::assertEquals(null, $input->form);
	}

	public function testNonControlElementRetursNullAsFormProperty() {
		$document = new HTMLDocument(Helper::HTML_FORM_PROPERTY);

		$span = $document->getElementById('non_form_control_1');
		self::assertEquals(null, $span->form);

		$span = $document->getElementById('non_form_control_2');
		self::assertEquals(null, $span->form);
	}

	public function testInputElementWithTypeImagetReturnsNullAsFormProperty() {
		$document = new HTMLDocument(Helper::HTML_FORM_PROPERTY);

		$input = $document->getElementById('f12');
		self::assertEquals(null, $input->form);
	}

	public function testPropertyAttributeCorrelationFormEncoding() {
		$document = new HTMLDocument(Helper::HTML_FORM_WITH_RADIOS);
		$form = $document->querySelector("form");
		$form->encoding = "phpgt/test";
		self::assertEquals("phpgt/test", $form->getAttribute("enctype"));
		self::assertEquals("phpgt/test", $form->enctype);
	}

	public function testPropertyAttributeCorrelationNormalAttribute() {
		$document = new HTMLDocument(Helper::HTML_FORM_WITH_RADIOS);
		$link = $document->querySelector("a");
		$link->href = "/test";
		self::assertEquals("/test", $link->getAttribute("href"));
		self::assertEquals("/test", $link->href);
	}

	public function testPropertyAttributeCorrelationBoolean() {
		$document = new HTMLDocument(Helper::HTML_FORM_PROPERTY);
		$input = $document->querySelector("input");
		$input->autofocus = true;
		self::assertTrue($input->autofocus);
		self::assertNotEmpty($input->getAttribute("autofocus"));
	}

	public function testPropertyDataset() {
		$document = new HTMLDocument(Helper::HTML_LESS);
		$p = $document->querySelector("p");
		$p->dataset->test = "Test Value";
		self::assertEquals("Test Value", $p->getAttribute("data-test"));

		$p->dataset->another = "Another test value";
		self::assertEquals("Test Value", $p->getAttribute("data-test"));
		self::assertEquals("Another test value", $p->getAttribute("data-another"));

		$p->dataset->propWithCamelCase = "Should be hyphenated";
		self::assertEquals("Should be hyphenated", $p->getAttribute("data-prop-with-camel-case"));
	}

	public function testPropertyValueAsDate() {
		$document = new HTMLDocument(Helper::HTML_FORM_WITH_DATES);
		$input = $document->querySelector("input");
		$input->value = "1988-04-05";
		$sut = $input->valueAsDate;
		self::assertInstanceOf(DateTime::class, $sut);
		self::assertEquals(new DateTime("1988-04-05"), $sut);
	}

	public function testPropertyValueAsNumber() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$input = $document->querySelector("input");
		self::assertEquals(0, $input->valueAsNumber);
		$input->value = "123.456";
		self::assertEquals(123.456, $input->valueAsNumber);
		self::assertIsFloat($input->valueAsNumber);
	}

	public function testAttributeValueSelection() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$input1 = $document->querySelector("input[name='who']");
		$input2 = $document->querySelector("input[name=who]");
		self::assertNotNull($input1);
		self::assertNotNull($input2);
		self::assertSame($input1, $input2);
		self::assertEquals("Scarlett", $input1->value);
	}

	public function testOptionValueGetSet() {
		$document = new HTMLDocument(Helper::HTML_SELECTS);
		foreach($document->querySelectorAll("[name=from] option") as $fromOption) {
			self::assertIsNumeric($fromOption->value);
		}

		foreach($document->querySelectorAll("[name=to] option") as $toOption) {
			self::assertIsNumeric($toOption->value);
		}
	}

	public function testSetClassNameProperty() {
		$document = new HTMLDocument();
		$element = $document->createElement("div");

		$element->className = "test";
		self::assertEquals("test", $element->getAttribute("class"));
	}

	public function testSetIdProperty() {
		$document = new HTMLDocument();
		$element = $document->createElement("div");

		$element->id = "test";
		self::assertEquals("test", $element->id);
	}

	public function testSetValueOnButton() {
		$document = new HTMLDocument();
		$element = $document->createElement("button");

		$element->value = "test";
		self::assertEquals("test", $element->value);
	}

	public function testSetOuterHTMLChangesElementInDocument() {
		$document = new HTMLDocument(Helper::HTML);
		$element = $document->querySelector("h1");
		$element->outerHTML = "<p>Hello!</p>";

		$newElement = $document->querySelector("p");

		self::assertNull($document->querySelector("h1"));
		self::assertNotNull($newElement);
		self::assertEquals("Hello!", $newElement->innerHTML);
		self::assertStringContainsString("<p>", $newElement->outerHTML);
	}

	public function testGetValueAsDateDoesNothingOnNonInputElements() {
		$document = new HTMLDocument(Helper::HTML_SELECTS);
		$element = $document->querySelector("select");

		$sut = $element->valueAsDate;

		self::assertNull($sut);
	}

	public function testGetValueAsNumberDoesNothingOnNonInputElements() {
		$document = new HTMLDocument(Helper::HTML_SELECTS);
		$element = $document->querySelector("select");

		$sut = $element->valueAsNumber;

		self::assertNull($sut);
	}

	public function testDebugInfoSelect() {
		$document = new HTMLDocument(Helper::HTML_SELECTS);
		$element = $document->querySelector("select");

		$sut = $element->__debugInfo();

		$expected = [
			'nodeName' => "select",
			'nodeValue' => "ZeroOneTwoThreeFourFive",
			'innerHTML' => '<option value="0">Zero</option><option value="1">One</option><option value="2">Two</option><option value="3">Three</option><option value="4">Four</option><option value="5">Five</option>',
			"class" => null,
			"name" => "from",
			"type" => null,
			"id" => null,
			"src" => null,
			"href" => null
		];

		self::assertEquals($expected["nodeName"], $sut["nodeName"]);
		self::assertEquals($expected["nodeValue"], trim(strtr($sut["nodeValue"], ["\t" => '', "\r" => '', "\n" => ''])));
		self::assertEquals($expected["innerHTML"], trim(strtr($sut["innerHTML"], ["\t" => '', "\r" => '', "\n" => ''])));
		self::assertEquals($expected['class'], $sut['class']);
		self::assertEquals($expected["name"], $sut["name"]);
		self::assertEquals($expected["type"], $sut["type"]);
		self::assertEquals($expected["id"], $sut["id"]);
		self::assertEquals($expected["src"], $sut["src"]);
		self::assertEquals($expected["href"], $sut["href"]);
	}

	public function testDebugInfoInput() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$element = $document->querySelector("input[name='who']");

		$sut = $element->__debugInfo();

		$expected = [
			'nodeName' => "input",
			'nodeValue' => "",
			'innerHTML' => "",
			"class" => 'c1 c3',
			"name" => "who",
			"type" => null,
			"id" => null,
			"src" => null,
			"href" => null,

		];
		// die(var_dump($sut));
		self::assertEquals($expected, $sut);
	}

	public function testDebugInfoAnchor() {
		$document = new HTMLDocument(Helper::HTML_TEXT);
		$element = $document->querySelector("a");

		$sut = $element->__debugInfo();

		$expected = [
			'nodeName' => "a",
			'nodeValue' => "casting a\n  ballot",
			'innerHTML' => "casting a\n  ballot",
			"class" => null,
			"name" => null,
			"type" => null,
			"id" => null,
			"src" => null,
			"href" => "http://en.wikipedia.org/wiki/Absentee_ballot",

		];
		self::assertEquals($expected, $sut);
	}

	public function testBooleanAttributes() {
		$document = new HTMLDocument();
		foreach(Element::BOOLEAN_ATTRIBUTES as $attribute) {
			$tagName = uniqid("custom-element-");
			$element = $document->createElement($tagName);

			self::assertFalse($element->hasAttribute($attribute));
			self::assertFalse($element->$attribute);
			$element->$attribute = true;
			self::assertTrue($element->$attribute);
			self::assertTrue($element->hasAttribute($attribute));
		}
	}
}