<?php

$html = <<<HTML
<!doctype html>

<h1>Hello, <span>you</span>!</h1>
HTML;

// Create a new document with the above HTML.
$document = new DOMDocument("1.0", "utf-8");
$document->loadHTML($html);

// Get reference to span tag.
$span = $document->getElementsByTagName("span")->item(0);

// Set the span's tag to user-supplied $name (malicious user can enter JavaScript!)
$name = "<script>alert('XSS');</script>";
$span->textContent = $name;

echo $document->saveHTML();
