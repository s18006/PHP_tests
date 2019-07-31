<?php

require_once 'Database.php';
require_once 'HtmlWriter.php';

class PageMaker {

    public static function makeWelcomePage(string $mailaddress, string $filename) {
        if (file_exists($filename)) {
            $tempname = explode('.', $filename);
            $time = date("YmdHms");
            $filename = $tempname[0].$time.'.'.$tempname[1];
        }
        $mailprop = Database::getProperties('maildata');
        $username = Database::getUsername($mailprop, $mailaddress);
        $writer = new HtmlWriter(fopen($filename, 'a'));
        $writer -> title('Welcome to' . $username . '\'s page!');
        $writer -> paragraph($username . 'のページへようこそ。');
        $writer -> paragraph('メール待っていますね。');
        $writer -> mailto($mailaddress, $username);
        $writer -> close();
        echo $filename . ' is created for ' . $mailaddress . '(' . $username . ')' . PHP_EOL;
    }
}


?>
