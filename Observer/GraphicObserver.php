<?php

require_once 'Observer.php';

class GraphicObserver implements Observer {

    public function update(NumberGenerator $generator):void {
        $count = $generator -> getNumber();
        $temp = '';
        for ($i = 0; $i < $count; $i++) {
            $temp .= '*';
        }
        echo 'GraphicObserver:' . $temp . PHP_EOL;

        try {
            sleep(10);
        } catch (Exception $e) {
            echo  $e -> getMessage() . PHP_EOL;
        }
    }
}

?>
