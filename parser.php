<?php
declare (strict_types = 1);
ini_set('memory_limit', '16384M');
ini_set('max_execution_time', '0');
require './CsvHandler.php';
require './CsvReader.php';
use ProductListManager\FileIterator as FileIterator;

$CombinationFile = getopt(null, ["unique-combinations:"]);
if (empty($CombinationFile)) {
    echo "Error, Missing  combination file parameter. 'unique-combination=ExampleCSVFilename'";
    exit;
}
$ProductFile = getopt(null, ["file:"]);
if (empty($ProductFile)) {
    echo "Error, Missing product file parameter. 'file=ExampleCSVFile'";
    exit;
}

/*********************************
 * Input source file
 *********************************/
define('INPUT_PRODUCT_FILE', $ProductFile);

/*********************************
 * Input Combination file
 *********************************/
define('INPUT_COMBINATION_FILE', $CombinationFile);

/*********************************
 * CSV_FOLDER
 *********************************/
define('SUB_FOLDER', 'csv');

$com = new ProductListProcessor\CsvCombined(SUB_FOLDER . '/' . INPUT_COMBINATION_FILE);

function countOccurrence($entry)
{
    $items = array();
    $items = $entry;
    $record = array_sum(array_column($items, 'count', 'make'));
    return $record;
}

$headers = $com->getHeaders();
$headCount = count($headers);
$lines = new FileIterator(SUB_FOLDER . '/' . INPUT_PRODUCT_FILE);
$temp = $result = array();
$rowData = array();
$limit = 500;
$row = 1;
for ($j = $row; $j < $limit; $j++) {
    foreach ($lines as $line) {
        $arr = explode(",", $line);
        $lineVals = array_values($arr);
        for ($i = 0; $i < $headCount; $i++) {
            $temp[$headers[$i]] = $lineVals[$i];
            $temp['count'] = 1;
        }
        $rowData[] = $temp;
    }
}
$total = count($rowData);
$column = array();
// Write to combination output csv file
if (($handle = fopen(SUB_FOLDER . '/' . INPUT_COMBINATION_FILE, "w")) !== false) {
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        // Alter your data
        for ($x = 0; $x < $total; $x++) {
            $row = $rowData[$x];
            $t = count($row);
            for ($y = 0; $y < $t; $y++) {
                $column = [$row['make'], $row['model'], $row['color'], $row['capacity'], $row['network'], $row['grade'], $row['condition'], $row['count']];
                $data[$x] = $column;
            }
        }
        // Write back to CSV format
        fputcsv($handle, $data);
    }
    fclose($handle);
}
