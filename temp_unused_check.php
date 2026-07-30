<?php

$base = __DIR__.'/app/Http/Controllers';
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($base));
$unused = [];

foreach ($files as $file) {
    if ($file->getExtension() !== 'php') {
        continue;
    }
    $path = $file->getPathname();
    $content = file_get_contents($path);
    preg_match_all('/^use\s+(?!function\s+|const\s+)([A-Z][\w\\\\]*);/m', $content, $matches, PREG_OFFSET_CAPTURE);
    foreach ($matches[1] as $i => $match) {
        $fullClass = $match[0];
        $shortName = substr($fullClass, strrpos($fullClass, '\\') + 1);
        $afterPosition = $matches[0][$i][1] + strlen($matches[0][$i][0]);
        $rest = substr($content, $afterPosition);
        if (! preg_match('/(?<![A-Za-z0-9_])'.preg_quote($shortName, '/').'(?![A-Za-z0-9_])/', $rest)) {
            $line = substr_count(substr($content, 0, $match[1]), "\n") + 1;
            $relPath = str_replace(dirname(__DIR__).'/', '', $path);
            echo "$relPath:$line: UNUSED IMPORT: $fullClass\n";
        }
    }
}

echo "\n--- Checking all app/ files ---\n";
$appBase = __DIR__.'/app';
$appFiles = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($appBase));
foreach ($appFiles as $file) {
    if ($file->getExtension() !== 'php') {
        continue;
    }
    $path = $file->getPathname();
    $content = file_get_contents($path);
    preg_match_all('/^use\s+(?!function\s+|const\s+)([A-Z][\w\\\\]*);/m', $content, $matches, PREG_OFFSET_CAPTURE);
    foreach ($matches[1] as $i => $match) {
        $fullClass = $match[0];
        $shortName = substr($fullClass, strrpos($fullClass, '\\') + 1);
        $afterPosition = $matches[0][$i][1] + strlen($matches[0][$i][0]);
        $rest = substr($content, $afterPosition);
        if (! preg_match('/(?<![A-Za-z0-9_])'.preg_quote($shortName, '/').'(?![A-Za-z0-9_])/', $rest)) {
            $line = substr_count(substr($content, 0, $match[1]), "\n") + 1;
            $relPath = str_replace(dirname(__DIR__).'/', '', $path);
            echo "$relPath:$line: UNUSED IMPORT: $fullClass\n";
        }
    }
}
