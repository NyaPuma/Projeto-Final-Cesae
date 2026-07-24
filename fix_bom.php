<?php
/**
 * Script to detect and fix UTF-8 BOM (Byte Order Mark) in PHP/Blade/JS files
 */
$rootDir = __DIR__;
$bomCount = 0;
$fixedCount = 0;

$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootDir, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

$allowedExtensions = ['php', 'blade.php', 'js', 'css', 'html', 'json', 'vue'];

foreach ($files as $file) {
    if ($file->isDir()) continue;
    
    $path = $file->getRealPath();
    
    // Skip vendor, node_modules, storage, bootstrap/cache
    if (strpos($path, DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR) !== false) continue;
    if (strpos($path, DIRECTORY_SEPARATOR . 'node_modules' . DIRECTORY_SEPARATOR) !== false) continue;
    if (strpos($path, DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR) !== false) continue;
    if (strpos($path, DIRECTORY_SEPARATOR . 'bootstrap' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR) !== false) continue;
    if (strpos($path, DIRECTORY_SEPARATOR . '.git' . DIRECTORY_SEPARATOR) !== false) continue;
    
    $ext = $file->getExtension();
    $filename = $file->getFilename();
    
    // Check for blade.php extension
    $isBlade = (strpos($filename, '.blade.php') !== false);
    
    // Filter by extension
    $check = false;
    if ($isBlade || in_array($ext, ['php', 'js', 'css', 'html', 'json', 'vue'])) {
        $check = true;
    }
    
    if (!$check) continue;
    
    $content = file_get_contents($path);
    if ($content === false) continue;
    
    // Check for UTF-8 BOM: 0xEF, 0xBB, 0xBF
    if (strlen($content) >= 3 && ord($content[0]) === 0xEF && ord($content[1]) === 0xBB && ord($content[2]) === 0xBF) {
        echo "BOM found in: " . substr($path, strlen($rootDir) + 1) . "\n";
        $bomCount++;
        
        // Remove BOM
        $newContent = substr($content, 3);
        if (file_put_contents($path, $newContent) !== false) {
            $fixedCount++;
            echo "  ✅ Fixed\n";
        } else {
            echo "  ❌ Failed to fix\n";
        }
    }
}

echo "\nTotal files with BOM: $bomCount\n";
echo "Files fixed: $fixedCount\n";

