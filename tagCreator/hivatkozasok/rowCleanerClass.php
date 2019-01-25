<?php
class rowCleanerClass {
    //html kod atalakitasa php kodda
    public function rowCleaner($input) {
        return preg_replace('/<br\s?\/?>/ius', "\n", str_replace("\n","",str_replace("\r","", htmlspecialchars_decode($input))));

    }
    //php kod atalakitasa html kodda
    public function rowTransform($input) {
        return strtr($input, array("\r\n" => '<br />', "\r" => '<br />', "\n" =>'<br />'));
    }
}

?>
