<?php

namespace App\Services\BookStore\Reader;

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
     *
     * @throws \Exception
     */
    public function __construct(string $file_path)
    {
        $this->file_path = $file_path;
        try {
            $jsonString = Storage::get($this->file_path);
        } catch (\Exception $e) {
            throw new FileNotFoundException('File not Found');
        }
        $this->data = json_decode($jsonString, true) ?? [];
    }

    /**
     * @return array
     */
    public function getData(): array{
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return void
     */
    public function setData(array $data): void {
        Storage::put($this->file_path, json_encode($data));
    }
}
