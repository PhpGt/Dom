<?php
use Gt\Dom\HTMLDocument;

require "vendor/autoload.php";

$content = <<<HTML
<div>
	<p id="testNodeText">
		Hello, Marcin!
	</p>
	<button class="btn-textNodeTest">Button</button>
</div>
<script>
{
	const p = document.querySelector("#testNodeText");
	const btn = document.querySelector(".btn-textNodeTest");
	
	const word1 = document.createTextNode("Psy");
	p.append(word1);
	
	p.append(" są ");
	
	const word2 = document.createTextNode("fajne");
	p.append(word2);
	
	btn.addEventListener("click", () => {
		console.dir(word1);
		
		word1.textContent = "Koty też";
		word2.textContent = "super!";
	});
}
</script>
HTML;

$document = new HTMLDocument($content);
echo $document;
