<?php

class Music {
    private string $name;
    private string $genre;
    private int $listen;

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

    public function GetGenre() {
        return $this->genre;
    }

    public function GetListen() {
        return $this->listen;
    }
}
?>