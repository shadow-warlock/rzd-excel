<?php

$db = new SQLite3('test.db');

$handle = fopen("output.csv", "r");
while (($data = fgetcsv($handle, 0, ":")) !== FALSE) {
    $db->exec("INSERT INTO xlsx_data VALUES('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]')");
}