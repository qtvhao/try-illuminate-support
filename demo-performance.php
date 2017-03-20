<?php
require_once 'vendor/autoload.php';
new \Illuminate\Support\Collection();
//we calculating how many an instance of Collection exceeded in-memory
$start = memory_get_usage();
$users = collect();
$end = memory_get_usage();
var_export($end - $start); #the memory amount in bytes = 312 bytes
echo "<br/>";
//we calculating how many an instance of Collection time to new
$start = microtime(1);
    collect();
$end = microtime(1);
var_export(($end - $start)*1e3);
#time to new Collection 0.0069 - 0.01ms
