<?php
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);
$input[0] = $input[0] - 71.5;
$input[1] = $input[1] - 15.4;
$input[2] = $input[2] - 15.2;
$input[3] = $input[3] - 11.9;
$input[4] = $input[4] - 0.2;
$input[5] = $input[5] - 24.8;
$input[6] = $input[6] - 49;

$findString = join(";", $input);
$findString = str_replace(".", ",", $findString);
$db = new SQLite3('test.db');
$data = $db->query("SELECT * FROM xlsx_data WHERE input1='$findString'");

$data = $data->fetchArray(SQLITE3_NUM);
foreach ($data as $k => $datum){
    if($datum === "Да" || $datum === "Нет" || $datum === "-"){
        if($datum === "Да")
            $data[$k] = true;
        else
            $data[$k] = false;
        continue;
    }
    $data[$k] = floatval(str_replace(",", ".", $datum));
}
$data[4] = $data[4]*100;
$data[5] = $data[5]/1000;
echo json_encode([
    "coal" => array_splice($data, 6, 5),
    "commercial_efficiency" =>array_splice($data, 1, 5)
]);