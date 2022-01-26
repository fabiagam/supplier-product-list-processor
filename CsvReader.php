<?php
namespace ProductListManager;

class FileIterator implements \Iterator
{
    protected $filePointer;
    protected $data;
    protected $key;
    public $csvArray = array();

    public function __construct($file)
    {
        $this->filePointer = fopen($file, 'rb');
        if (!$this->filePointer) {
            throw new \Exception('File could not be opened');
        };
    }

    public function __destruct()
    {
        fclose($this->filePointer);
    }
    public function current()
    {
        return $this->data;
    }
    public function key()
    {
        return $this->key;
    }
    public function next(): void
    {
        $this->data = fgets($this->filePointer);
        $this->key++;
    }
    public function rewind(): void
    {
        fseek($this->filePointer, 0);
        $this->data = fgets($this->filePointer);
        $this->key = 0;
    }
    public function valid(): bool
    {
        return false !== $this->data;
    }
}
