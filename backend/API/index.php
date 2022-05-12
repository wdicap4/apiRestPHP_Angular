<?php
// Collect data from our API
$articles = json_decode(file_get_contents("http://127.0.0.1:8080"));
ob_start();
?>
