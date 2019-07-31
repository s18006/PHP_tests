<?php

class Database {

    public static function getProperties(string $dbname) {
        $filename = $dbname .'.txt';
        if (file_exists($filename)) {
            $content = explode("\n", file_get_contents($filename));
            $prop = array();
            foreach ($content as $key => $value) {
                if ($value !== '') {
                    $splittedValue = explode('=', $value);
                    $prop[$splittedValue[0]] = $splittedValue[1];
                }
            }
            return $prop;
        } else {
            echo 'File is not found.';
        }
    }

    public static function getUserName(array $prop, string $mailaddress) {
        if (isset($prop[$mailaddress])) {
            return $prop[$mailaddress];
        } else {
            return "Mailaddress is not found";
        }
    }
}

?>
