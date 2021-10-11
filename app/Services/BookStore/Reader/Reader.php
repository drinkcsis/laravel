<?php

namespace App\Services\Book\Reader;

interface Reader {
    public function getData(): array;
    public function setData(array $data): viod;
}
