<?php
abstract class AbstractDisplay {
    public abstract function open();
    public abstract function printer();
    public abstract function close();

    public function display() {
        $temp = $this -> open();
        for ($i = 0; $i < 5; $i++) {
            $temp .= $this -> printer();
        }
        $this -> close();
        return $temp;
    }
}
?>
