<img src="logo.png" alt="The modern DOM API for PHP 7 projects" align="right" />

# Modern DOM API.

Built on top of PHP's native [DOMDocument](http://php.net/manual/en/book.dom.php), this project provides access to modern DOM APIs, as you would expect working with client-side code in the browser.

Performing DOM manipulation in your server-side code enhances the way dynamic pages can be built. Utilising a standardised object-oriented interface means the page can be ready-processed, benefitting browsers, webservers and content delivery networks.

***

<a href="https://github.com/PhpGt/Dom/actions" target="_blank">
	<img src="https://badge.status.php.gt/dom-build.svg" alt="Build status" />
</a>
<a href="https://scrutinizer-ci.com/g/PhpGt/Dom" target="_blank">
	<img src="https://badge.status.php.gt/dom-quality.svg" alt="Code quality" />
</a>
<a href="https://scrutinizer-ci.com/g/PhpGt/Dom" target="_blank">
	<img src="https://badge.status.php.gt/dom-coverage.svg" alt="Code coverage" />
</a>
<a href="https://packagist.org/packages/PhpGt/Dom" target="_blank">
	<img src="https://badge.status.php.gt/dom-version.svg" alt="Current version" />
</a>
<a href="http://www.php.gt/dom" target="_blank">
	<img src="https://badge.status.php.gt/dom-docs.svg" alt="PHP.Gt/Dom documentation" />
</a>

## Example usage: Hello, you!

> **Important note:** the example shown here is for illustrative purposes, but using the DOM to directly set data to elements' values tightly couples the logic to the view, which is considered bad practice. Please see the [DomTemplate](https://php.gt/domtemplate) library for a more robust solution to binding data to the DOM.

Consider a page with a form, with an input element to enter your name. When the form is submitted, the page should greet you by your name.

This is a simple example of how source HTML files can be treated as templates. This can easily be applied to more advanced template pages to provide dynamic content, without requiring non-standard techniques such as `{{curly braces}}` for placeholders, or `echo '<div class='easy-mistake'>' . $content['opa'] . '</div>'` error-prone HTML construction from within PHP.

### Source HTML (`name.html`)

```html
<!doctype html>
<h1>
	Hello, <span class="name-output">you</span> !
</h1>

<form>
	<input name="name" placeholder="Your name, please" required />
	<button>Submit</button>
</form>
```

### PHP used to inject your name (`index.php`)

```php
<?php
use Gt\Dom\HTMLDocument;
use Gt\Dom\HTMLElement\HTMLSpanElement;
require "vendor/autoload.php";

$html = file_get_contents("name.html");
$document = new HTMLDocument($html);

if(isset($_GET["name"])) {
	/** @var HTMLSpanElement $span */
	$span = $document->querySelector(".name-output");
	$span->innerText = $_GET["name"];
}

echo $document;
```

## Features at a glance

+ Compatible with W3C's DOM Living Standard:
	+ Classes for all types of `HTMLElement`, such as `HTMLAnchorElement` (`<a>`), `HTMLButtonElement` (`<button>`), `HTMLInputElement` (`<input>`), `HTMLTableSectionElement` (`<thead>`, `<tbody>`, `<tfoot>`), etc.
	+ `DOMException` extensions for catching different types of exception, such as `EnumeratedValueException`, `HierarchyRequestError`, `IndexSizeException`, etc.
	+ Client-side functionality stubbed including classes for `FileList`, `StyleSheet`, `VideoTrackList`, `WindowProxy`, etc.
+ DOM level 4+ functionality:
	+ Reference elements using CSS selectors via [`Element::querySelector()`][mdn-qs] and ([`Element::querySelectorAll()`][mdn-qsa])
	+ Add/remove/toggle elements' classes using [`ClassList`][mdn-classList]
	+ Traverse Element-only Nodes with [`Element::previousElementSibling`][mdn-pes], [`Element::nextElementSibling`][mdn-nes], [`Element::children`][mdn-children] and [`Element::lastElementChild`][mdn-lec] and [`firstElementChild`][mdn-fec], etc.
	+ Insert and remove child Nodes with [`ChildNode::remove()`][mdn-remove], [`ChildNode::before`][mdn-before], [`ChildNode::after`][mdn-after], [`ChildNode::replaceWith()`][mdn-replaceWith]
+ Standard properties on the `HTMLDocument`:
	+ [`anchors`][mdn-anchors]
	+ [`forms`][mdn-forms]
	+ [`image`][mdn-images]
	+ [`links`][mdn-links]
	+ [`scripts`][mdn-scripts]
	+ [`title`][mdn-title]


### Data binding and page template features

This repository is intended to be as accurate to the DOM specification as possible. An extension to the repository is available at https://php.gt/domtemplate which adds page templating and data binding through custom elements and template attributes, introducing serverside functionality similar to that of WebComponents.

[mdn-HTMLDocument]: https://developer.mozilla.org/docs/Web/API/HTMLDocument
[mdn-Element]: https://developer.mozilla.org/docs/Web/API/Element
[mdn-HTMLCollection]: https://developer.mozilla.org/docs/Web/API/HTMLCollection
[mdn-DOM-levels]: https://developer.mozilla.org/docs/DOM_Levels
[mdn-qs]: https://developer.mozilla.org/docs/Web/API/Element/querySelector
[mdn-qsa]: https://developer.mozilla.org/docs/Web/API/Element/querySelectorAll
[mdn-classList]: https://developer.mozilla.org/docs/Web/API/Element/classList
[mdn-pes]: https://developer.mozilla.org/docs/Web/API/NonDocumentTypeChildNode/previousElementSibling
[mdn-nes]: https://developer.mozilla.org/en-US/docs/Web/API/NonDocumentTypeChildNode/nextElementSibling
[mdn-children]: https://developer.mozilla.org/en-US/docs/Web/API/ParentNode/children
[mdn-lec]: https://developer.mozilla.org/docs/Web/API/ParentNode/lastElementChild
[mdn-fec]: https://developer.mozilla.org/docs/Web/API/ParentNode/firstElementChild
[mdn-remove]: https://developer.mozilla.org/docs/Web/API/ChildNode/remove
[mdn-before]: https://developer.mozilla.org/docs/Web/API/ChildNode/before
[mdn-after]: https://developer.mozilla.org/docs/Web/API/ChildNode/after
[mdn-replaceWith]: https://developer.mozilla.org/docs/Web/API/ChildNode/replaceWith
[mdn-anchors]: https://developer.mozilla.org/docs/Web/API/Document/anchors
[mdn-forms]: https://developer.mozilla.org/docs/Web/API/Document/forms
[mdn-images]: https://developer.mozilla.org/docs/Web/API/Document/images
[mdn-links]: https://developer.mozilla.org/docs/Web/API/Document/links
[mdn-scripts]: https://developer.mozilla.org/docs/Web/API/Document/scripts
[mdn-title]: https://developer.mozilla.org/docs/Web/API/Document/title
