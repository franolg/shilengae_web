<?php
// include '../private/connect.php'; // including every class from the root/private/connect.php.

$db = Database::getInstance();
$c = $db->getc();

function formatBytes($bytes, $precision = 2) { 
    $units = array('<small>B</small>', '<small>KB</small>', '<small>MB</small>', '<small>GB</small>', '<small>TB</small>'); 

    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 

    // Uncomment one of the following alternatives
    $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow)); 

    return round($bytes, $precision) . ' ' . $units[$pow]; 
} 
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator('../')
);

$totalSize = 0;
foreach ($iterator as $file) {
    $totalSize += $file->getSize();
}

function numberof($val){
    global $c;
    $sq = $c->query("SELECT * FROM $val");
    $num = $sq->num_rows;
    return $num;
}

?>