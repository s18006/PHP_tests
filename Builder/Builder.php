<?php
abstract class Builder {
    public abstract function makeTitle($title);
    public abstract function makeString($str);
    public abstract function makeItems($items);
    public abstract function close();
}
?>
