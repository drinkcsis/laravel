<?php

namespace App\Services\BookStore;

interface BookStoreService {

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function findByName(string $name): array;

    /**
     * @param string $genre
     * @param string $bookName
     * @param string $bookAuthor
     *
     * @return array
     */
    public function store(string $genre, string $bookName, string $bookAuthor): array;
}
