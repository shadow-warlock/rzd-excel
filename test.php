<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

echo 1;
$spreadsheet = IOFactory::load("table.xlsm");
$spreadsheet->getCellXfByIndex(0);