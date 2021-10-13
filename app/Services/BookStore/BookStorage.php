<?php

namespace App\Services\BookStore;

use App\Services\BookStore\Reader\Reader;

class BookStorage implements BookStoreService {

    /**
     * @var array $books
     */
    protected $books = [];

    /**
     * @var Reader $reader
     */
    protected $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
        $this->books = $this->reader->getData();
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

        $this->reader->setData($this->books);

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
