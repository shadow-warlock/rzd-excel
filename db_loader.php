<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$db = new SQLite3('test.db');

$handle = fopen("rzd-2-1.csv", "r");
while (($data = fgetcsv($handle, 0, ":")) !== FALSE) {
    $db->exec("INSERT INTO xlsx_data VALUES('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]')");
}