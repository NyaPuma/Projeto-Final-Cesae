<?php

$dirs = ['app', 'config', 'routes', 'resources', 'database', 'tests'];
$fixedCount = 0;

foreach ($dirs as $dir) {
    if (!is_dir($dir)) continue;
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS)
    );

    foreach ($iterator as $file) {
        if ($file->isDir()) continue;
        $path = $file->getRealPath();
        $content = file_get_contents($path);
        if ($content === false) continue;

        // Check UTF-8 BOM
        if (strlen($content) >= 3 && ord($content[0]) === 0xEF && ord($content[1]) === 0xBB && ord($content[2]) === 0xBF) {
            $content = substr($content, 3);
            file_put_contents($path, $content);
            echo "Fixed UTF-8 BOM: {$path}\n";
            $fixedCount++;
        }

        // Check UTF-16 LE BOM (FF FE) or Null bytes in PHP files
        if (strlen($content) >= 2 && ord($content[0]) === 0xFF && ord($content[1]) === 0xFE) {
            $converted = mb_convert_encoding($content, 'UTF-8', 'UTF-16LE');
            // Remove BOM if present
            if (strlen($converted) >= 3 && ord($converted[0]) === 0xEF && ord($converted[1]) === 0xBB && ord($converted[2]) === 0xBF) {
                $converted = substr($converted, 3);
            }
            file_put_contents($path, ltrim($converted, "\xEF\xBB\xBF\xFF\xFE"));
            echo "Fixed UTF-16 LE: {$path}\n";
            $fixedCount++;
        } elseif (str_contains($content, "\x00") && in_array($file->getExtension(), ['php', 'json', 'yaml', 'yml'])) {
            $converted = mb_convert_encoding($content, 'UTF-8', 'UTF-16LE');
            file_put_contents($path, ltrim($converted, "\xEF\xBB\xBF\xFF\xFE\x00"));
            echo "Fixed Null bytes / UTF-16: {$path}\n";
            $fixedCount++;
        }
    }
}

echo "Finished! Total files fixed: {$fixedCount}\n";
