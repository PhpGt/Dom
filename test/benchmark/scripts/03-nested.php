<?php /** @noinspection PhpElementIsNotAvailableInCurrentPhpVersionInspection */
use Dom\HTMLDocument as NativeHTMLDocument;
use Gt\Dom\HTMLDocument;

require __DIR__ . "/../../../vendor/autoload.php";

$timeArray = [];

foreach([HTMLDocument::class, NativeHTMLDocument::class] as $domClassName) {
	$timeStart = microtime(true);
	echo "Using $domClassName", PHP_EOL;
	$document = match($domClassName) {
		HTMLDocument::class => new HTMLDocument(),
		NativeHTMLDocument::class => NativeHTMLDocument::createFromString(HTMLDocument::DOCTYPE),
	};

	for($i = 0; $i < 1_000; $i++) {
		$element = $document->createElement("parent-element");
		$document->body->appendChild($element);

		$nested = null;
		for($j = 0; $j < 100; $j++) {
			$appendTo = $element;
			if($nested) {
				$appendTo = $nested;
			}
			$nested = $document->createElement("nested-element$j");
			$appendTo->appendChild($nested);
		}
	}

	echo str_replace("\n", "", $document->saveHTML()), PHP_EOL;
	$timeEnd = microtime(true);
	$timeArray[$domClassName] = $timeEnd - $timeStart;
}

echo PHP_EOL;

foreach($timeArray as $className => $time) {
	echo "$className: " . number_format($time, 4), PHP_EOL;
}

$percentDifference = abs(
	($timeArray[array_keys($timeArray)[0]] - $timeArray[array_keys($timeArray)[1]])
	/ max($timeArray) * 100
);
echo "Speed increase: " . number_format($percentDifference, 0) . "%", PHP_EOL;
