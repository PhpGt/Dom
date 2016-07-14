# phpgt dom
The modern DOM API for PHP 7 projects

***

<a href="https://gitter.im/phpgt/dom" target="_blank">
    <img src="https://img.shields.io/gitter/room/phpgt/dom.svg?style=flat-square" alt="Gitter chat" />
</a>
<a href="https://circleci.com/gh/phpgt/dom" target="_blank">
    <img src="https://img.shields.io/circleci/project/phpgt/dom/master.svg?style=flat-square" alt="Build status" />
</a>
<a href="https://scrutinizer-ci.com/g/phpgt/dom" target="_blank">
    <img src="https://img.shields.io/scrutinizer/g/phpgt/dom/master.svg?style=flat-square" alt="Code quality" />
</a>
<a href="https://scrutinizer-ci.com/g/phpgt/dom" target="_blank">
    <img src="https://img.shields.io/scrutinizer/coverage/g/phpgt/dom/master.svg?style=flat-square" alt="Code coverage" />
</a>
<a href="https://packagist.org/packages/phpgt/dom" target="_blank">
    <img src="https://img.shields.io/packagist/v/phpgt/dom.svg?style=flat-square" alt="Current version" />
</a>

Built on top of PHP's native [DOMDocument](http://php.net/manual/en/book.dom.php), this project provides access to modern DOM APIs, as you would expect working with client-side code in the browser.

Performing DOM manipulation in your server-side code enhances the way dynamic pages can be built. Utilising a standardised object-oriented interface means the page can be ready-processed, benefitting browsers, webservers and content delivery networks.

## Example usage: Hello, you!

Consider a page with a form, with an input element to enter your name. When the form is submitted, the page should greet you by your name.

This is a simple example of how source HTML files can be treated as templates. This can easily be applied to more advanced template pages to provide dynamic content, without requiring non-standard techniques such as `{{curly braces}}` for placeholders, or `echo '<div class='easy-mistake'>' . $content['opa'] . '</div>'` horrible HTML construction from within PHP.

### Source HTML (`name.html`):

```html
<!doctype html>
<h1>
    Hello, <span id="your-name">you</span> !
</h1>

<form>
    <input name="name" placeholder="Your name, please" required />
    <button>Submit</button>
</form>
```

### PHP used to inject your name (`index.php`):

```php
<?php
require "vendor/autoload.php";

$html = file_get_contents("name.html");
$document = new \phpgt\dom\HTMLDocument($html);

if(isset($_GET["name"])) {
    $document->getElementById("your-name")->textContent = $_GET["name"];
}

echo $document->saveHTML();
```

### Animated GIF of above example:

// TODO.

## Features at a glance

// TODO: List out DOM features with brief description.
