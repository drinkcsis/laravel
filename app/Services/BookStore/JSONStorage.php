<?php

namespace App\Services\Book;

use Illuminate\Support\Facades\Storage;

class JSONStorage implements BookStoreService {

    /**
     * @var $books array
     */
    protected $books = [];

    /**
     * @var $file_path string
     */
    protected $file_path;

    public function __construct()
    {
        $this->file_path = config('books.file_path');
        $jsonString = Storage::get($this->file_path);
        $this->books = json_decode($jsonString, true);
    }

    /**
     * @param $name string
     *
     * @return array
     */
    public function findByName(string $name): array {
        return array_reduce($this->books, static function($result, $booksInGenre) use ($name) {
            $listOfBookKeys = array_keys(preg_grep ("/{$name}/i", array_column($booksInGenre, 'name')));
            foreach ($listOfBookKeys as $key) {
                $result[] = $booksInGenre[$key];
            }
            return $result;
        }, []);
    }

    /**
     * @param string $genre
     * @param string $bookName
     * @param string $bookAuthor
     *
     * @return array
     */
    public function store(string $genre, string $bookName, string $bookAuthor): array {
        if(!array_key_exists($genre, $this->books)) {
            $this->books[$genre] = [];
        }
        $bookIndex = $this->isBookExists($genre, $bookName);
        if($bookIndex !== false) {
            $this->books[$genre][$bookIndex]['author'] = $bookAuthor;
        } else {
            $this->books[$genre][] = [
                'name' => $bookName,
                'author' => $bookAuthor
            ];
        }

        Storage::put($this->file_path, json_encode($this->books));

        return $this->books;
    }

    /**
     * @param $genre string
     * @param $bookName string
     *
     * @return false|int
     */
    protected function isBookExists(string $genre, string $bookName) {
        return array_search($bookName, array_column($this->books[$genre], 'name'), true);
    }
}
