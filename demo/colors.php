<?php
$forceAdapter = isset($argv[1]) ? ucfirst(trim($argv[1])) : null;
$forceCharset = isset($argv[2]) ? ucfirst(trim($argv[2])) : null;
require_once __DIR__ . '/_init.php';

$width = $console->getWidth();
$height = $console->getHeight();
