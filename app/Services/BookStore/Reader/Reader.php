<?php

namespace App\Services\BookStore\Reader;

interface Reader {
    public function getData(): array;
    public function setData(array $data): void;
}
