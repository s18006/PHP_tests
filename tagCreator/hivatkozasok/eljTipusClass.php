<?php
class eljTipusClass  {
    public function eljTipus ($input) {
        $result = '';
        if ($input === 'nyilt115') {
            $result = 'Kbt. 115. § szerinti nyílt közbeszerzési eljárás';
        } else if ($input === 'nyilt113') {
            $result = 'Kbt. 113. § szerinti nyílt közbeszerzési eljárás';
        } else {
            $result = 'közösségi értékhatár szerinti nyílt közbeszerzési eljárás';
        }
        return $result;
    }
}

?>
