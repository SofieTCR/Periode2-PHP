<?php

class Music {
    public string $name;
    public string $genre;
    public int $listen;

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