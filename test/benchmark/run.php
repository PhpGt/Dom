<?php
echo "Running benchmarks...", PHP_EOL;

$fileList = glob(__DIR__ . "/scripts/*.php");
$outputList = [];

foreach($fileList as $phpFile) {
	echo "Executing: ", basename($phpFile), PHP_EOL;

	$output = null;
	$returnVar = null;

	exec("php " . escapeshellarg($phpFile), $output, $returnVar);

	array_push($outputList, $output);

	if($returnVar !== 0) {
		echo "Error: Script ", basename($phpFile), " exited with code $returnVar", PHP_EOL;
	}
}

echo "--------", PHP_EOL;

foreach($fileList as $i => $file) {
	$basename = pathinfo($file, PATHINFO_BASENAME);
	echo "$basename output: ";
	$output = $outputList[$i];

	foreach($output as $line) {
		echo strlen($line) > 120 ? substr($line, 0, 120) . "..." : $line;
		echo PHP_EOL;
	}
	echo PHP_EOL, "--------", PHP_EOL;
}
