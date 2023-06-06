<?php 

class ListenList {
    public array $music;

    function AddMusic(array $music) {
        $this->music[] = $music;
    }
}
?>