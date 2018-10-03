<?php
namespace Gt\Dom\Test\Helper;

class Helper {
	const HTML = "<!doctype html><html><body><h1>Hello!</h1></body></html>";
	const HTML_EMOJI = <<<HTML
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test!</title>
</head>
<body>
	<h1>☆ Hello ☆ World ☆</h1>
</body>
</html>
HTML;
	const HTML_LESS = <<<HTML
<!doctype html>
<meta charset="utf-8" />
<title>Hello, World!</title>
<link rel="stylesheet" href="/style/main.css" />
<p>This is a test.</p>
HTML;
	const HTML_MORE = <<<HTML
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Test HTML</title>
</head>
<body>
	<h1>
		This HTML is for the unit test.
	</h1>
	<img src="header.jpg" />
	<a name="firstParagraph"></a>
	<p>There are a few elements in this document.</p>
	<p>This is so we can test different traversal methods.</p>
	<p class="plug">This package is a part of the phpgt webengine.</p>
	<h2 id="who" class="h-who m-before-p m-test">Who made this?</h2>
	<p class="link-to-twitter" data-social="twitter" data-social-username="g105b">
		<a href="https://twitter.com/g105b">Greg Bowler</a> started this project
		to bring modern DOM techniques to the server side.
	</p>
	<a name="forms"></a>

	Here's some text that isn't contained within an element.

	<form>
		<input name="fieldA" type="text" />
		<input name="who" class="c1 c3" value="Scarlett" />
		<button type="submit">Submit</button>
	</form>
	<form>
		<input name="fieldB" type="text" class="c1 c2 c3 c4" />
		<img src="bottomForm.jpg" />
	</form>
</body>
</html>
HTML;

	const HTML_SECTIONS_WITHIN_FORM = <<<HTML
<!doctype html>
<form id="example-form">
	<section><h1>Section 1</h1></section>
	<section><h1>Section 2</h1></section>
	<section><h1>Section 3</h1></section>
	<section><h1>Section 4</h1></section>
</form>
HTML;

	const HTML_TEXT = <<<HTML
<p>Thru-hiking is great!  <strong>No insipid election coverage!</strong>
  However, <a href="http://en.wikipedia.org/wiki/Absentee_ballot">casting a
  ballot</a> is tricky.</p>
HTML;
	const HTML_NESTED = <<<HTML
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Test HTML</title>
</head>
<body>
	<div class="container">
		<div class="header">Lorem Header</div>
		<div class="body">
			<h1>Lorem Page</h1>
			<ul class="outer-list">
				<li class="outer-item-1">
					<div class="post outer">
						<h1>Lorem Title</h1>
						<div class="body">
							<p>Lorem Ipsum <a href="http://example.com">dolor sit</a></p>
						</div>
						<ul class="inner-list">
							<li class="inner-item-1">
								<div class="post inner">
									<h1>Lorem Title</h1>
									<div class="body">
										<p>Curabitur finibus imperdiet felis <a href="http://anotherexample.com">dolor sit</a></p>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
	</div>
</body>
</html>
HTML;
	const HTML_VALUE = <<<HTML
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Test HTML</title>
</head>
<body>

	<select id="select">
		<option value="1">One</option>
		<option value="2">Two</option>
	</select>

	<select id="select_optgroup">
		<option value="1">One</option>
		<option value="2">Two</option>
		<optgroup>
			<option value="3" selected>Three</option>
			<option value="4">Four</option>
		</optgroup>
	</select>

	<select id="select_selected">
		<option value="1">One</option>
		<option value="2" selected="selected">Two</option>
	</select>

	<select id="select_empty"></select>

</body>
</html>
HTML;

	const HTML_TEMPLATE_NO_ATTRIBUTE_VALUE = <<<HTML
<div>
	<p>The following paragraph element has a data attribute with no value, which is not valid XML.</p>
	<p data-example>This breaks the import of DOMDocumentFragment, so should be fixed by Gt/Dom.</p>
</div>
HTML;

	const XML = <<<XML
<?xml version="1.0" encoding="UTF-8" ?>
<breakfast-menu>
	<food>
		<name>Belgian Waffles</name>
		<price>$5.95</price>
		<description>two of our famous Belgian Waffles with plenty of real maple syrup</description>
		<calories>650</calories>
	</food>
	<food>
		<name>Strawberry Belgian Waffles</name>
		<price>$7.95</price>
		<description>light Belgian waffles covered with strawberrys and whipped cream</description>
		<calories>900</calories>
	</food>
	<food>
		<name>Berry-Berry Belgian Waffles</name>
		<price>$8.95</price>
		<description>light Belgian waffles covered with an assortment of fresh berries and whipped cream</description>
		<calories>900</calories>
	</food>
	<food>
		<name>French Toast</name>
		<price>$4.50</price>
		<description>thick slices made from our homemade sourdough bread</description>
		<calories>600</calories>
	</food>
	<food>
		<name>Homestyle Breakfast</name>
		<price>$6.95</price>
		<description>two eggs, bacon or sausage, toast, and our ever-popular hash browns</description>
		<calories>950</calories>
	</food>
</breakfast-menu>
XML;

/**
 * Below this line is all code that is used in documentation.
 */

// https://github.com/PhpGt/Dom/wiki/Classes-that-make-up-DOM#moving-an-attribute-between-elements
	const DOCS_ATTR_GETATTRIBUTENODE = <<<HTML
<!doctype html>
<ul id="shop-items">
	<li id="arduino">Arduino</li>
	<li id="raspberry-pi" class="special-offer special-offer-two-for-one">Raspberry Pi</li>
	<li id="class">PIC</li>
</ul>
HTML;

// https://github.com/PhpGt/Dom/wiki/Classes-that-make-up-DOM#childnode
	const DOCS_CHILDNODE_REPLACEWITH = <<<HTML
<!doctype html>
<form method="post">
	<button id="buttonA" name="order" value="A">A</button>
	<button id="buttonB" name="order" value="B">B</button>
	<button id="buttonC" name="order" value="C">C</button>
</form>
HTML;

	const DOCS_DOCUMENTFRAGMENT_PAGE = <<<HTML
<ul class="shop-item-list">
	<li>
		<shop-item id="123" name="Raspberry Pi" price="34.44"></shop-item>
	</li>
	<li>
		<shop-item id="456" name="Arduino" price="16.99"></shop-item>
	</li>
</ul>
HTML;

	const DOCS_DOCUMENTFRAGMENT_TEMPLATE = <<<HTML
<a href="/shop/item/">
	<h1>ITEM NAME</h1>
	<h2>£0.00</h2>
</a>
HTML;

// Ethnic groups taken from UK Government census data:
// https://en.wikipedia.org/wiki/Classification_of_ethnicity_in_the_United_Kingdom
const HTML_FORM_WITH_RADIOS = <<<HTML
<!doctype>
<form>
	<p>What is your ethnic group?</p>
	<label>
		<span>White</span>
		<input type="radio" name="ethnic-group" value="white" />
	</label>
	<label>
		<span>Mixed / multiple ethnic groups</span>
		<input type="radio" name="ethnic-group" value="mixed" />
	</label>
	<label>
		<span>Asian / Asian British</span>
		<input type="radio" name="ethnic-group" value="asian" />
	</label>
	<label>
		<span>Black / African / Caribbean / Black British</span>
		<input type="radio" name="ethnic-group" value="black" />
	</label>
	<label>
		<span>Other ethnic group</span>
		<input type="radio" name="ethnic-group" value="other" />
	</label>
	
	<button name="do" value="submit-ethnicity">Submit</button>
</form>
HTML;

}