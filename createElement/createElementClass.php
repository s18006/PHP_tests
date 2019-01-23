<?php

class createElementClass {
    public function createNewElement($input, $type, $id) {
        if ($type === 'div') {
            return self::createDiv($input, $id);
        }
        if ($type === 'h1') {
            return self::createH1($input, $id);
        }

        if ($type === 'h2') {
            return self::createH2($input, $id);
        }
    }

    public function createDiv($input, $id) {
        $result = '<div id="'.$id.'">'. htmlspecialchars($input) .'</div>';
        return $result;
    }

    public function createH1($input, $id) {
        $result = '<h1 id="'.$id.'">'. htmlspecialchars($input) .'</h1>';
        return $result;
    }

    public function createH2 ($input, $id) {
        $result = '<h2 id ="'.$id.'">'. htmlspecialchars($input) .'</h2>';
        return $result;
    }
}

?>
