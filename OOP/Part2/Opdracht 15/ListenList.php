<?php 

class ListenList {
    public array $music = array();

    function AddMusic(Music $music) {
        if ($this->checkMusic($music)) {
            $this->music[] = $music;
        }
    }

    private function checkMusic(Music $music2){
        if (in_array($music2, $this->music)) {
            return false;
        }
        else {
            return true;
        }
    }
}
?>