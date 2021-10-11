<?php

namespace App\Services\Book\Reader;

use Illuminate\Support\Facades\Storage;

class JSONReader implements Reader {

    /**
     * @var $data array
     */
    protected $data = [];
    /**
     * @var $file_path string
     */
    protected $file_path;

    /**
     * JSONReader constructor.
     *
     * @param string $file_path
     */
    public function __construct(string $file_path)
    {
        $this->file_path = $file_path;
        $jsonString = Storage::get($this->file_path);
        $this->data = json_decode($jsonString, true);
    }

    /**
     * @return array
     */
    public function getData(): array{
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data){
        Storage::put($this->file_path, json_encode($data));
    }
}
