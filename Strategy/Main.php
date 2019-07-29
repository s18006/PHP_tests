<?php

require_once 'Strategy.php';
require_once 'WinningStrategy.php';
require_once 'ProbStrategy.php';
require_once 'Player.php';
require_once 'Hand.php';

class Main {
    public function __construct() {
        $player1 = new Player("Taro", new WinningStrategy(1));
        $player2 = new Player("Thomas", new ProbStrategy(2));
        for ($i = 0; $i < 3; $i++) {
            $nextHand1 = $player1 -> nextHand();
            $nextHand2 = $player2 -> nextHand();
            if ($nextHand1 -> isStrongerThan($nextHand2)) {
                echo 'Winner: player1' . PHP_EOL;
                $player1 -> win();
                $player2 -> lose();
            } else if ($nextHand2 -> isStrongerThan($nextHand1)) {
                echo 'Winner: player2' . PHP_EOL;
                $player2 -> win();
                $player1 -> lose();
            } else {
                echo 'Even...' . PHP_EOL;
                $player1 -> even();
                $player2 -> even();
            }
            echo $player1 -> toString() . PHP_EOL;
            echo $player2 -> toString() . PHP_EOL;
        }
    }
}

$main = new Main();


?>
