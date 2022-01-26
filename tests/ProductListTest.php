<?php
declare (strict_types = 1);

define('ROOT', $_SERVER['DOCUMENT_ROOT']);

include ROOT . 'CsvReader.php';
use PHPUnit\Framework\TestCase;
use ProductListManager\FileIterator as FileIterator;

define('INPUT_PRODUCT_FILE', 'products_comma_separated.csv');
define('SUB_FOLDER', 'csv');

class ProductListTest extends TestCase
{

    public function testIsCSVDataValid()
    {
        $file = new FileIterator(SUB_FOLDER . '/' . INPUT_PRODUCT_FILE);
        return $this->assertTrue($file->valid());
    }

}
