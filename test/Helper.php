<?php
namespace phpgt\dom\test;

class Helper {

const HTML = "<!doctype html><html><body><h1>Hello!</h1></body></html>";
const HTML_MORE = <<<HTML
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Test HTML</title>
</head>
<body>
	<h1>This HTML is for the unit test.</h1>
	<p>There are a few elements in this document.</p>
	<p>This is so we can test different traversal methods.</p>
	<p class="plug">This package is a part of the phpgt webengine.</p>
	<h2>Who made this?</h2>
	<p>
		<a href="https://twitter.com/g105b">Greg Bowler</a> started this project
		to bring modern DOM techniques to the server side.
	</p>
</body>
HTML;

}#