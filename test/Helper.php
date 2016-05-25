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
	<h1>
		This HTML is for the unit test.
	</h1>
	<img src="header.jpg" />
	<a name="firstParagraph"></a>
	<p>There are a few elements in this document.</p>
	<p>This is so we can test different traversal methods.</p>
	<p class="plug">This package is a part of the phpgt webengine.</p>
	<h2 id="who">Who made this?</h2>
	<p>
		<a href="https://twitter.com/g105b">Greg Bowler</a> started this project
		to bring modern DOM techniques to the server side.
	</p>
	<a name="forms"></a>

	Here's some text that isn't contained within an element.

	<form>
		<input name="fieldA" type="text">
		<button type="submit">Submit</button>
	</form>
	<form>
		<input name="fieldB" type="text">
		<img src="bottomForm.jpg" />
	</form>
</body>
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
                    <div class="post">
                        <h1>Lorem Title</h1>
                        <div class="body">
                            <p>Lorem Ipsum <a href="http://example.com">dolor sit</a></p>
                        </div>
                        <ul class="inner-list">
                            <li class="inner-item-1">
                                <div class="post">
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
HTML;

}#