<?php

$document = new DOMDocument("1.0", "UTF-8");
$document->registerNodeClass(DOMNode::class, MyDOMNode::class);
$document->registerNodeClass(DOMElement::class, MyDOMElement::class);
$document->registerNodeClass(DOMDocumentFragment::class, MyDOMDocumentFragment::class);

$html = <<<HTML
<!doctype html>
<h1>Hello, <span>you</span>!</h1>

<form method="post">
	<label>
		<span>Your name, please</span>
		<input id="name-input" name="your-name" required autocomplete="off" autofocus />
	</label>
	
	<button name="do" value="greet">Greet!</button>
</form>
HTML;
$document->loadHTML($html);

$input = $document->getElementById("name-input");

var_dump($input);

class DOMString implements Stringable {
	public static function createFromCallback(Closure $param) {

	}

	public function __toString():string {

	}
}

class MyDOMNode extends DOMNode {

}

class MyDOMElement extends DOMElement {
	public string $tagName = "test";

	public function __invoke() {
		die(__METHOD__);
	}
}

class MyDOMDocumentFragment extends DOMDocumentFragment {

}
