<?php
namespace ProductListProcessor;

class CsvHandler
{
    protected $file;

    public function __construct($filePath)
    {
        $this->file = fopen($filePath, 'r');
    }

    public function rows()
    {
        //memory_get_usage(true);
        while (!feof($this->file)) {
            $row = fgetcsv($this->file, 4096, ',');
            yield $row;
        }

        return;
    }

}

class CsvCombined
{

    protected $file;

    public $csvHead = array("model_name",
        "condition_name",
        "grade_name",
        "gb_spec_name",
        "colour_name",
        "network_name",
        "");

    public function __construct($filePath)
    {
        $this->file = fopen($filePath, 'r');
    }

    public function getHeaders()
    {
        if (($this->file) !== false) {
            $data = fgetcsv($this->file, ",");
            $numCols = count($data);
            $tempHeader = [];
            for ($i = 0; $i < $numCols; $i++) {
                array_push($tempHeader, $data[$i]);
            }
            return $tempHeader;
        }
    }

}
