<?php
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);
foreach ($input as $k => $datum){
    if($datum === "Да" || $datum === "Нет" || $datum === "-"){
        continue;
    }
    if($datum === true || $datum === false){
        $input[$k] = $datum ? "Да" : "Нет";
        continue;
    }
    $input[$k] = $input[$k]/100;
}

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
    if($k == 2 || $k == 6){
        $data[$k] = $data[$k]*100;
    }
    $data[$k] = round($data[$k], 1);
}

echo json_encode($data);