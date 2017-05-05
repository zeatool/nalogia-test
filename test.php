<?php
include "Anagram.php";
header('Content-Type: text/html; charset=utf-8');

$start = microtime(true);

$anagram = new Anagram([2, 3, 4, 5, 6]);
$anagram->search();
foreach ($anagram->represent() as $represent) {
    echo $represent."<BR>";
}

echo sprintf("Расчет занял %01.3f сек", microtime(true) - $start);