<?php

require_once 'File.php';
require_once 'Directories.php';

class Main {

    public function __construct() {
        try {
            echo 'Making root entries...'. PHP_EOL;
            $rootdir = new Directories('root');
            $bindir = new Directories('bin');
            $tmpdir = new Directories('tmp');
            $usrdir = new Directories('usr');

            $rootdir -> add($bindir);
            $rootdir -> add($tmpdir);
            $rootdir -> add($usrdir);
            $bindir -> add(new File('vi', 10000));
            $bindir -> add(new File('latex', 20000));
            $rootdir -> printList("");


            echo 'Making user entries...'. PHP_EOL;
            $yuki = new Directories('yuki');
            $hanako = new Directories('hanako');
            $tomura = new Directories('tomura');
            $usrdir -> add($yuki);
            $usrdir -> add($hanako);
            $usrdir -> add($tomura);
            $yuki -> add(new File('diary.html', 100));
            $yuki -> add(new File('Composite.java', 200));
            $hanako -> add(new File('memo.text', 300));
            $tomura -> add(new File('game.doc', 400));
            $tomura -> add(new File('junk.mail', 500));
            $rootdir -> printList("");

        } catch (Exception $e) {
            echo $e -> getMessage();
        }
    }
}

$main = new Main();
?>
