<?php

abstract class Support {

    private $name;
    private $next;

    public function __construct(string $name) {
        $this -> name = $name;
    }

    public function setNext(Support $next) {
        $this -> next = $next;
        return $this -> next;
    }

    public final function support(Trouble $trouble):void {
        if ($this -> resolve($trouble)) {
            $this -> done($trouble);
        } else if ($this -> next !== null) {
            $this -> next -> support($trouble);
        } else {
            $this -> fail($trouble);
        }
    }

    //decision method
    protected abstract function resolve(Trouble $trouble):bool;

    public function __tostring():string {
        return "[" . $this -> name ."]";
    }

    //done method calls tostring methods automatically
    protected function done(Trouble $trouble) {
        echo $trouble . "is resolved by " . $this . ".\n";
    }

    //done method calls tostring method of Trouble class automatically
    protected function fail(Trouble $trouble) {
        echo $trouble . "cannot be resolved.\n";
    }
}
?>
