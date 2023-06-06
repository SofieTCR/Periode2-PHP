<?php

class Music {
    public $name;
    public $genre;
    public $listen;

    /**
     * @param string $name
     * @param string $genre
     * @param int $listen
     */

    public function __construct(string $name, string $genre, int $listen) {
        $this->name = $name;
        $this->genre = $genre;
        $this->listen = $listen;
    }

    public function GetName() {
        return $this->name;
    }
}
?>