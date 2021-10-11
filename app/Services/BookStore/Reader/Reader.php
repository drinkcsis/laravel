<?php

namespace App\Services\Book;

interface Reader {
    public function getData(): array;
    public function setData(array $data);
}
